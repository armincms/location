<?php

namespace Armincms\Location\Nova\Actions; 

use Illuminate\Support\Collection; 
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Actions\Action;
use Armincms\Location\Models\LocationState;
use Armincms\Location\Helper;

class ImportStates extends Action
{     
    /**
     * Perform the action on the given models.
     *
     * @param  \Laravel\Nova\Fields\ActionFields  $fields
     * @param  \Illuminate\Support\Collection  $models
     * @return mixed
     */
    public function handle(ActionFields $fields, Collection $models)
    {  
        $country = $models->first();   
        $states = $this->getStates($country)->map(function($state) use ($country) {
            return [
                'country_id' => $country->id,
                'active' => 0,
                'name' => json_encode([
                    app()->getLocale() => $state['name']
                ]),
            ];
        });

        LocationState::insert($states->values()->all());
    } 

    public function getStates($country)
    {
        return $this->filterDuplicates(Helper::getCountryStatesByIsoCode($country->iso));
    }

    public function filterDuplicates($states)
    {
        $availableStates = LocationState::get()->map->name;

        return $states->filter(function($state) use ($availableStates) {
            return ! $availableStates->contains($state['name']); 
        });
    }
}

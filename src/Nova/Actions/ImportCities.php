<?php

namespace Armincms\Location\Nova\Actions; 

use Illuminate\Support\Collection; 
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Actions\Action;
use Armincms\Location\Models\LocationCity;
use Armincms\Location\Helper;

class ImportCities extends Action
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
        $state = $models->first()->load('country');   
        $cities = $this->getCities($state)->map(function($city) use ($fields, $state) {
            return [
                'state_id' => $state->id,
                'active' => 0,
                'name' => json_encode([
                    app()->getLocale() => $city['name']
                ]),
            ];
        });

        LocationCity::insert($cities->values()->all());
    }

    public function getCities($state)
    {
        $states = Helper::getCountryStatesByIsoCode($state->country->iso);

        return $this->filterDuplicates($states->where('name', $state->name)->flatMap->cities);
    } 

    public function filterDuplicates($cities)
    {
        $availableCities = LocationCity::get()->map->name;

        return $cities->filter(function($city) use ($availableCities) {
            return ! $availableCities->contains($city['name']); 
        });
    }
}

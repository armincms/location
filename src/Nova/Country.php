<?php

namespace Armincms\Location\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\{ID, Text, Boolean, HasMany};
use Armincms\Fields\Targomaan;

class Country extends Resource
{    
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \Armincms\Location\Models\LocationCountry::class;

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            ID::make(__("ID"), 'id')->sortable(), 

            new Targomaan([
                Text::make(__('Country Name'), 'name') 
                    ->rules('required')
                    ->sortable()
                    ->required(), 
            ]), 

            Text::make(__('ISO Code'), 'iso')->sortable(),

            Boolean::make(__('Active'), 'active')->sortable(),

            HasMany::make(__('States'), 'states', State::class),
        ]; 
    } 

    /**
     * Get the actions available on the entity.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function actions(Request $request)
    {
        return array_merge(parent::actions($request), [  
            (new Actions\ImportStates)->canSee(function() {
                return \Auth::guard('admin')->check();
            })->onlyOnTableRow(),
        ]);
    }
}

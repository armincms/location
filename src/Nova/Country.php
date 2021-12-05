<?php

namespace Armincms\Location\Nova;

use Armincms\Fields\Targomaan;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\Text;

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
            new Targomaan([
                Text::make(__('Country Name'), 'name') 
                    ->rules('required') 
                    ->required(), 
            ]), 

            Text::make(__('ISO Code'), 'iso')->required(),

            Boolean::make(__('Active'), 'active'),

            HasMany::make(__('States'), 'states', State::class),
        ]; 
    } 

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fieldsForIndex(Request $request)
    {
        return [
            ID::make(__('ID'), 'id')->sortable(),
 
            Text::make(__('Country Name'), 'name')->sortable(),   

            Boolean::make(__('Active'), 'active')->sortable(),
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
            Actions\ImportStates::make()->onlyOnTableRow(),
        ]);
    }
}

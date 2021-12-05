<?php

namespace Armincms\Location\Nova; 

use Armincms\Fields\Targomaan; 
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\Text;

class State extends Resource
{   
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \Armincms\Location\Models\LocationState::class;

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            ID::make(__('ID'), 'id')->sortable(), 

            BelongsTo::make(__('Country'), 'country', Country::class) 
                ->showCreateRelationButton() 
                ->withoutTrashed()
                ->required()
                ->rules('required'),

            new Targomaan([
                Text::make(__('State Name'), 'name') 
                    ->rules('required')
                    ->required(), 
            ]),  

            Boolean::make(__('Active'), 'active')->sortable(),

            HasMany::make(__('Cities'), 'cities', City::class),
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
 
            Text::make(__('State Name'), 'name')->sortable(),   

            Boolean::make(__('Active'), 'active')->sortable(),

            BelongsTo::make(__('Country'), 'country', Country::class)->sortable(),
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
            Actions\ImportCities::make()->onlyOnTableRow(),
        ]);
    }
}

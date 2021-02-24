<?php

namespace Armincms\Location\Nova; 

use Illuminate\Http\Request;
use Laravel\Nova\Fields\{ID, Text, Boolean, BelongsTo};
use Armincms\Fields\Targomaan;

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
                    ->sortable()
                    ->required(), 
            ]),  

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
        return [ 
            (new Actions\ImportCities)->canSee(function() {
                return \Auth::guard('admin')->check();
            })->onlyOnTableRow(),
        ];
    }
}

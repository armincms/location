<?php

namespace Armincms\Location\Nova;

use Illuminate\Http\Request; 
use Laravel\Nova\Fields\{ID, Text, Boolean, BelongsTo};
use GeneaLabs\NovaMapMarkerField\MapMarker;
use Armincms\Fields\Targomaan;

class Zone extends Resource
{     
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \Armincms\Location\Models\LocationZone::class;

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

            BelongsTo::make(__('City'), 'city', City::class) 
                ->showCreateRelationButton() 
                ->withoutTrashed()
                ->required()
                ->rules('required'),

            new Targomaan([
                Text::make(__('Zone Name'), 'name') 
                    ->rules('required')
                    ->sortable()
                    ->required(), 
            ]),  

            Boolean::make(__('Active'), 'active')->sortable(),

            MapMarker::make(__('Google Location'), 'location')
                ->defaultZoom(16)
                ->defaultLatitude(41.823611)
                ->defaultLongitude(-71.422222)
                ->centerCircle(10, 'red', 1, .5),
        ]; 
    }
}

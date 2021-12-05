<?php

namespace Armincms\Location\Nova;

use Armincms\Fields\Targomaan; 
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\Text;
use GeneaLabs\NovaMapMarkerField\MapMarker; 

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
 
            Text::make(__('Zone Name'), 'name')->sortable(),   

            Boolean::make(__('Active'), 'active')->sortable(),

            BelongsTo::make(__('City'), 'city', City::class)->sortable(),
        ];
    }
}

<?php

namespace Armincms\Location\Nova;
 
use Armincms\Contract\Nova\Fields;   
use Laravel\Nova\Http\Requests\NovaRequest; 
use Laravel\Nova\Resource as NovaResource;
use Illuminate\Http\Request;    

abstract class Resource extends NovaResource
{  
    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'name';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id', 'name'
    ]; 

    /**
     * The columns that should be searched as JSON.
     *
     * @var array
     */
    public static $searchJson = [
        'name'
    ]; 

    /**
     * The logical group associated with the resource.
     *
     * @var string
     */
    public static $group = 'Locations';   

    /**
     * Get the actions available on the entity.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function actions(Request $request)
    {
        return [
            new Actions\Activate,

            new Actions\Inactivate,
        ];
    }

    /**
     * Return the location to redirect the user after creation.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @param  \Laravel\Nova\Resource  $resource
     * @return string
     */
    public static function redirectAfterCreate(NovaRequest $request, $resource)
    {
        return '/resources/'.static::uriKey();
    }

    /**
     * Return the location to redirect the user after update.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @param  \Laravel\Nova\Resource  $resource
     * @return string
     */
    public static function redirectAfterUpdate(NovaRequest $request, $resource)
    {
        return '/resources/'.static::uriKey();
    }
}

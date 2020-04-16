<?php

namespace Armincms\Location\Nova;
 
use Laravel\Nova\Http\Requests\NovaRequest; 
use Laravel\Nova\Resource as NovaResource;
use Illuminate\Http\Request;  

use Laravel\Nova\Fields\Field;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Select; 

use Armincms\Nova\Resource as ArminResource;   


abstract class Resource extends ArminResource
{ 
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'Armincms\Location\Location';

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
        'id'
    ];

    /**
     * The columns that should be searched in the translation table.
     *
     * @var array
     */
    public static $searchTranslations = [
        'name'
    ];

    /**
     * The logical group associated with the resource.
     *
     * @var string
     */
    public static $group = 'Locations';  

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        return collect([
            ID::make(__("ID"), 'id')->sortable(),

            $this->translatable([
                Text::make(__("Name"), 'name')->sortable(),
            ]), 

            optional(static::belongsTo())->sortable(),

            Boolean::make(__('Active'), 'active') 
                ->sortable(),
             
        ])->filter()->all(); 
    } 

    /**
     * Get the realted resource field.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Laravel\Nova\Fields\Field
     */
    abstract public function belongsTo();
 
    /**
     * Build an "index" query for the given resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public static function indexQuery(NovaRequest $request, $query)
    {
        return $query->where($query->qualifyColumn('resource'), static::class);
    } 
}

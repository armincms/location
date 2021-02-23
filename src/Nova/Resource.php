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
use Armincms\Fields\Targomaan; 
use Armincms\Fields\InteractsWithJsonTranslator; 
use Armincms\Nova\Resource as ArminResource;   


abstract class Resource extends ArminResource
{ 
    use InteractsWithJsonTranslator;

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
}

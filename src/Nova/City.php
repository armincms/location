<?php

namespace Armincms\Location\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\{Field, BelongsTo};     

class City extends State
{     
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \Armincms\Location\Models\LocationCity::class;

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        return array_map(function($field) {
            if(! is_subclass_of($field, Field::class) || $field->attribute !== 'country') {
                return $field;
            }

            return BelongsTo::make(__('State'), 'state', State::class) 
                        ->showCreateRelationButton() 
                        ->withoutTrashed()
                        ->required()
                        ->rules('required');
        }, parent::fields($request));
    }
}

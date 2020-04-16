<?php

namespace Armincms\Location\Nova;

use Illuminate\Http\Request;

class Country extends Resource
{   
    /**
     * Get the realted resource field.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Laravel\Nova\Fields\Field
     */
    public function belongsTo()
    { 
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
        	(new Actions\ImportCountries)->canSee(function() {
        		return ! option("_countries_imported_", 0) && \Auth::guard('admin')->check();
        	}),

            (new Actions\ImportStates)->canSee(function() {
                return \Auth::guard('admin')->check();
            })->onlyOnTableRow(),
        ];
    }
}

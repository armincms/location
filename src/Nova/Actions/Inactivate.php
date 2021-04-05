<?php

namespace Armincms\Location\Nova\Actions; 

use Illuminate\Support\Collection; 
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Actions\Action; 

class Inactivate extends Action
{     
    /**
     * Perform the action on the given models.
     *
     * @param  \Laravel\Nova\Fields\ActionFields  $fields
     * @param  \Illuminate\Support\Collection  $models
     * @return mixed
     */
    public function handle(ActionFields $fields, Collection $models)
    {  
        $models->each->inactivate();
    } 
}

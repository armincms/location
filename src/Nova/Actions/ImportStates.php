<?php

namespace Armincms\Location\Nova\Actions; 

use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;

class ImportStates extends Import
{    
    public function resource(): string
    {
        return "Armincms\\Location\\Nova\\State";
    }

    public function filterInsertions(Collection $insertions, Model $model) : Collection
    {
    	return $insertions->map(function($insertion) {  
    		$insertion['config'] = json_encode([
    			"location_id" => $insertion['location_id']
    		]);

    		unset($insertion['citites']); 

    		return $insertion;
    	});
    }

    public function loadCountry(Model $model) : Model
    {
    	return $model->load('Location')->location;
    }
}

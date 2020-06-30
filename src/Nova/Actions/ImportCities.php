<?php

namespace Armincms\Location\Nova\Actions; 

use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;

class ImportCities extends Import
{    
    public function resource(): string
    {
        return "Armincms\\Location\\Nova\\City";
    }

    public function filterInsertions(Collection $insertions, Model $model) : Collection
    {
    	if($insertion = $insertions->where("name", $model->name)->first()) {
    		return collect($insertion['citites'])->map(function($city, $index) {
    			return array_merge($city, [
    				'location_id' => $index,
    				'config' => json_encode([
		    			"location_id" => $index
		    		])
    			]);
    		});
    	}  
    }

    public function loadCountry(Model $model) : Model
    {
    	return $model->load('location')->location;
    }
}

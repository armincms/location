<?php 

namespace Armincms\Location\Concerns; 
  

trait QueriesCityRelationship 
{   

	public function cities()
	{
		return $this->belongsToMany(\Armincms\Location\Models\LocationCity::class, 'location_locatable')
					->where('resource', \Armincms\Location\Nova\City::class)
					->pivots('resource');
	}

	/**
	 * Query the related LocationCity.
	 * 
	 * @return
	 */
	public function city()
	{
		return $this->belongsTo(\Armincms\Location\Models\LocationCity::class);
	} 

	/**
	 * Query where has give city id.
	 * 
	 * @param  \Illuminate\Database\Eloquent\Query\Builder $query 
	 * @param  int $cityId  
	 * @return \Illuminate\Database\Eloquent\Query\Builder        
	 */
	public function scopeInCity($query, int $cityId)
	{
		return $query->where($query->qualifyColumn('city_id'), $cityId);
	}  
}
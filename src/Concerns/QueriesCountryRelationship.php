<?php 

namespace Armincms\Location\Concerns; 
  

trait QueriesCountryRelationship 
{   
	/**
	 * Query the related LocationCountry.
	 * 
	 * @return
	 */
	public function country()
	{
		return $this->belongsTo(Armincms\Location\Models\LocationCountry::class);
	} 

	/**
	 * Query where has give country id.
	 * 
	 * @param  \Illuminate\Database\Eloquent\Query\Builder $query 
	 * @param  int $countryId 
	 * @return \Illuminate\Database\Eloquent\Query\Builder        
	 */
	public function scopeInCountry($query, int $countryId)
	{
		return $query->where($query->qualifyColumn('country_id'), $countryId);
	}  
}
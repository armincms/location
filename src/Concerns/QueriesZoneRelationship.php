<?php 

namespace Armincms\Location\Concerns; 
  

trait QueriesZoneRelationship 
{   
	/**
	 * Query the related LocationZone.
	 * 
	 * @return
	 */
	public function zone()
	{
		return $this->belongsTo(\Armincms\Location\Models\LocationZone::class);
	} 

	/**
	 * Query where has give zone id.
	 * 
	 * @param  \Illuminate\Database\Eloquent\Query\Builder $query 
	 * @param  int $zoneId  
	 * @return \Illuminate\Database\Eloquent\Query\Builder        
	 */
	public function scopeInZone($query, int $zoneId)
	{
		return $query->where($query->qualifyColumn('zone_id'), $zoneId);
	}  
}
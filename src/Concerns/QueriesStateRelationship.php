<?php 

namespace Armincms\Location\Concerns; 
  

trait QueriesStateRelationship 
{   
	/**
	 * Query the related LocationState.
	 * 
	 * @return
	 */
	public function state()
	{
		return $this->belongsTo(\Armincms\Location\Models\LocationState::class);
	} 

	/**
	 * Query where has give state id.
	 * 
	 * @param  \Illuminate\Database\Eloquent\Query\Builder $query 
	 * @param  int $stateId 
	 * @return \Illuminate\Database\Eloquent\Query\Builder        
	 */
	public function scopeInState($query, int $stateId)
	{
		return $query->where($query->qualifyColumn('state_id'), $stateId);
	}  
}
<?php 

namespace Armincms\Location\Models; 


class LocationCountry extends Model
{ 
	/**
	 * Query the related LocationState.
	 * 
	 * @return \Illuminate\Database\Eloqeunt\Relatios\HasOneOrMany
	 */
	public function states()
	{
		return $this->hasMany(LocationState::class, 'country_id');
	}
}
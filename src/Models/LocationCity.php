<?php 

namespace Armincms\Location\Models; 


class LocationCity extends Model
{ 
	/**
	 * Query the related LocationCountry.
	 * 
	 * @return \Illuminate\Database\Eloqeunt\Relations\BelongsTo
	 */
	public function state()
	{
		return $this->belongsTo(LocationState::class);
	}

	/**
	 * Query the related LocationZone.
	 * 
	 * @return \Illuminate\Database\Eloqeunt\Relations\HasOneOrMany
	 */
	public function zones()
	{
		return $this->hasMany(LocationZone::class, 'city_id');
	}
}
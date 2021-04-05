<?php 

namespace Armincms\Location\Models; 


class LocationState extends Model
{ 
	/**
	 * Query the related LocationCountry.
	 * 
	 * @return \Illuminate\Database\Eloqeunt\Relations\BelongsTo
	 */
	public function country()
	{
		return $this->belongsTo(LocationCountry::class);
	}

	/**
	 * Query the related LocationCountry.
	 * 
	 * @return \Illuminate\Database\Eloqeunt\Relations\HasOneOrMany
	 */
	public function cities()
	{
		return $this->hasMany(LocationCity::class, 'state_id');
	}
}
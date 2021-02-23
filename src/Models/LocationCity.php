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
}
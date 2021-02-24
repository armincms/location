<?php 

namespace Armincms\Location\Models; 


class LocationZone extends Model
{ 
	/**
	 * Query the related LocationCountry.
	 * 
	 * @return \Illuminate\Database\Eloqeunt\Relations\BelongsTo
	 */
	public function city()
	{
		return $this->belongsTo(LocationCity::class);
	}
}
<?php 

namespace Armincms\Location\Concerns; 
 
use Armincms\Location\Location;


trait Locatable 
{   
	public function zone()
	{
		return $this->location('zone_id');
	}

	public function zones()
	{
		return $this->locations()->where(function($query) { 
			$query->zone();
		});
	}

	public function scopeInZone($query, int $zone)
	{
		return $query->locatedAt($zone, 'zone_id');
	}

	public function scopeInZones($query, array $zones)
	{
		return $query->inLocations($zones, 'zones');
	}

	public function city()
	{
		return $this->location('city_id');
	} 

	public function cities()
	{
		return $this->locations()->where(function($query) {
			$query->city();
		});
	}

	public function scopeInCity($query, int $city)
	{
		return $query->locatedAt($city, 'city_id');
	}

	public function scopeInCities($query, array $cities)
	{
		return $query->inLocations($cities, 'cities');
	}

	public function state()
	{
		return $this->location('state_id');
	} 

	public function states()
	{
		return $this->locations()->where(function($query) {
			$query->state();
		});
	}

	public function scopeInState($query, int $state)
	{
		return $query->locatedAt($state, 'state_id');
	}

	public function scopeInStates($query, array $states)
	{
		return $query->inLocations($states, 'states');
	}

	public function country()
	{
		return $this->location('country_id');
	}

	public function countries()
	{
		return $this->locations()->where(function($query) {
			$query->country();
		});
	}

	public function scopeInCountry($query, int $country)
	{
		return $query->locatedAt($country, 'country_id');
	}

	public function scopeInCountries($query, array $countries)
	{
		return $query->inLocations($countries, 'countries');
	}

	public function location(string $foreignKey = 'location_id')
	{
		return $this->belongsTo(Location::class, $foreignKey);
	}

	public function locations()
	{
		return $this->morphToMany(Location::class, 'locatable');
	} 

	public function scopeInLocations($query, array $locations, string $scope = 'locations')
	{ 
		return $query->whereHas($scope, function($query) use ($locations) { 
			$query->whereKey($locations);
		});
	}

	public function scopeLocatedAt($query, $value, string $foreignKey = 'location_id')
	{ 
		return $query->where($query->qualifyColumn($foreignKey), $value);
	}
}
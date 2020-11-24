<?php 

namespace Armincms\Location; 

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Armincms\Targomaan\Concerns\InteractsWithTargomaan; 
use Armincms\Targomaan\Contracts\Translatable; 
use Laravel\Nova\Nova as LaravelNova;

class Location extends Model implements Translatable
{
	use InteractsWithTargomaan, SoftDeletes;

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = []; 

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'config' => 'json'
    ];

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {  
        parent::boot();

        static::saving(function($model) {   
            $model->resource = LaravelNova::resourceForKey(request()->route('resource')); 
        });
    }
 
    /**
     * The related location relationship.
     * 
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function location()
    {
        return $this->belongsTo(static::class);
    } 
 
    /**
     * The related locations relationship.
     * 
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function locations()
    {
        return $this->hasMany(static::class, 'location_id');
    } 
 
    /**
     * The related locations relationship.
     * 
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function zones()
    {
        return $this->locations();
    } 
 
    /**
     * The related locations relationship.
     * 
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function cities()
    {
        return $this->locations();
    } 
 
    /**
     * The related locations relationship.
     * 
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function states()
    {
        return $this->locations();
    } 

    /**
     * Driver name of the targomaan.
     * 
     * @return string
     */
    public function translator(): string
    {
        return 'json';
    } 

    /**
     * Filter the `zone` resources. 
     * 
     * @param  \Illuminate\Database\Eloquent\Query\Builder $query     
     * @return \Illuminate\Database\Eloquent\Query\Builder $query           
     */
    public function scopeZone($query)
    {
        return $query->resource(Nova\Zone::class);
    } 

    /**
     * Filter the `city` resources. 
     * 
     * @param  \Illuminate\Database\Eloquent\Query\Builder $query     
     * @return \Illuminate\Database\Eloquent\Query\Builder $query           
     */
    public function scopeCity($query)
    {
        return $query->resource(Nova\City::class);
    } 

    /**
     * Filter the `country` resources. 
     * 
     * @param  \Illuminate\Database\Eloquent\Query\Builder $query     
     * @return \Illuminate\Database\Eloquent\Query\Builder $query           
     */
    public function scopeState($query)
    {
        return $query->resource(Nova\State::class);
    } 

    /**
     * Filter the `country` resources. 
     * 
     * @param  \Illuminate\Database\Eloquent\Query\Builder $query     
     * @return \Illuminate\Database\Eloquent\Query\Builder $query           
     */
    public function scopeCountry($query)
    {
        return $query->resource(Nova\Country::class);
    }

    /**
     * Filter query by the given resource. 
     * 
     * @param  \Illuminate\Database\Eloquent\Query\Builder $query    
     * @param  string $location 
     * @return \Illuminate\Database\Eloquent\Query\Builder $query           
     */
    public function scopeResource($query, $resource)
    {
        return $query->whereIn($query->qualifyColumn('resource'), (array) $resource);
    }
}
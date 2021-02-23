<?php 

namespace Armincms\Location\Models; 

use Illuminate\Database\Eloquent\{Model as LaravelModel, SoftDeletes}; 
use Armincms\Targomaan\Concerns\InteractsWithTargomaan; 
use Armincms\Targomaan\Contracts\Translatable;  

abstract class Model extends LaravelModel implements Translatable
{
	use InteractsWithTargomaan, SoftDeletes;

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false; 

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [ 
    ]; 

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
     * Query where the active columns is "true".
     * 
     * @param  \Illuminate\Database\Eloquent\Builder $query 
     * @return \Illuminate\Database\Eloquent\Builder        
     */
    public function scopeActive($query)
    {
        return $query->whereActive(true);
    }
}
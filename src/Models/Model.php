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

    /**
     * Determine if active column is true.
     * 
     * @return boolean 
     */
    public function isActive() : bool
    {
        return boolval($this->active);
    }

    /**
     * Determine if active column is false.
     * 
     * @return boolean 
     */
    public function isNotActive() : bool
    {
        return ! $this->isActive();
    }

    /**
     * Set the active column as true if not.
     * 
     * @return $this
     */
    public function activate()
    {
        if ($this->isNotActive()) {
            $this->forceFill(['active' => 1])->save();
        }

        return $this;
    }

    /**
     * Set the active column as false if not.
     * 
     * @return $this
     */
    public function inactivate()
    {
        if ($this->isActive()) {
            $this->forceFill(['active' => 0])->save();
        }

        return $this;
    }
}
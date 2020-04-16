<?php 
namespace Armincms\Location;


use Armincms\Localization\Concerns\HasTranslation;
use Armincms\Localization\Contracts\Translatable; 
use Illuminate\Database\Eloquent\Model;
use Laravel\Nova\Nova;

class Location extends Model implements Translatable
{
	use HasTranslation ;

	public $timestamps 	= false; 
	protected $guarded 	= [];
    protected $with  = [
        "translations"
    ];
	protected $casts	= [
		'config' => 'json'
	]; 

    public static function boot()
    {
        parent::boot();

        static::saving(function($model) {   
            $model->resource = Nova::resourceForKey(request()->route('resource')); 
        });
    }
 

    public function location()
    {
        return $this->belongsTo($this);
    } 
}
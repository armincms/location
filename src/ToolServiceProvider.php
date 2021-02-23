<?php

namespace Armincms\Location;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Laravel\Nova\Events\ServingNova;
use Laravel\Nova\Nova as LaravelNova;
use Illuminate\Database\Schema\Blueprint;
use Armincms\Location\Http\Middleware\Authorize;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider;

class ToolServiceProvider extends AuthServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [ 
        Country::class =>  Policies\Country::class, 
        State::class =>  Policies\State::class, 
        City::class =>  Policies\City::class, 
    ];

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadJsonTranslationsFrom(__DIR__.'/../resources/lang'); 

        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

        LaravelNova::serving([$this, 'servingNova']);
  
        // $citites = collect(require __DIR__.'/../database/city.php');

        // $counties = collect(require __DIR__.'/../database/county.php')->map(function($county, $index) use ($citites) {
        //     $county['citites'] = $citites->where('county_id', $index + 1);
        //     return $county; 
        // });

        // $ir = collect(require __DIR__.'/../database/province.php')->map(function($province) use ($counties) {
        //     $province['citites'] = $counties->where('province_id', $province['province_id'])->pluck('citites')->flatten(1); 
        //     return $province;
        // });

        // \File::put(__DIR__.'/ir.json', $ir->toJson(JSON_PRETTY_PRINT));

        // dd(1);

    } 

    public function servingNova(ServingNova $event)
    {
        LaravelNova::resources([
            Nova\Country::class,
            Nova\State::class, 
            Nova\City::class,
            // Nova\Zone::class,
        ]);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
         // Auth blueprint
        Blueprint::macro('location', function($name = 'user') {
            return tap($this->unsignedBigInteger("{$name}_id"), function() use ($name) { 

                $this
                    ->foreign("{$name}_id")->references('id')->on('locations')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');

                $this->index(["{$name}_id"]);
            });
        });
    }
}

<?php

namespace Armincms\Location;

use Illuminate\Contracts\Support\DeferrableProvider;
use Laravel\Nova\Nova as LaravelNova;
use Illuminate\Database\Schema\Blueprint;
use Armincms\Location\Http\Middleware\Authorize;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider;

class ServiceProvider extends AuthServiceProvider implements DeferrableProvider
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
        Zone::class =>  Policies\Zone::class, 
    ]; 

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->servingNova(); 
        $this->registerPolicies();
        $this->registerBlueprintMacros();
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
    }

    /**
     * Register any nova services.
     *  
     * @return void
     */
    public function servingNova()
    {
        LaravelNova::resources([
            Nova\Country::class,
            Nova\State::class, 
            Nova\City::class,
            Nova\Zone::class,
        ]);
    }

    /**
     * Regsiter Blueprint macros.
     * 
     * @return void
     */
    public function registerBlueprintMacros()
    {
        // Country blueprint
        Blueprint::macro('country', function($name = 'country_id') {
            return $this->createForeignColumnCallback($name, 'location_countries');
        });
        Blueprint::macro('dropCountry', function($name = 'country_id') {
            $this->dropForeignColumnCallback($name); 
        });
        // State blueprint
        Blueprint::macro('state', function($name = 'state_id') {
            return $this->createForeignColumnCallback($name, 'location_states');
        });
        Blueprint::macro('dropState', function($name = 'state_id') {
            $this->dropForeignColumnCallback($name); 
        });
        // City blueprint
        Blueprint::macro('city', function($name = 'city_id') {
            return $this->createForeignColumnCallback($name, 'location_citites');
        });
        Blueprint::macro('dropCity', function($name = 'city_id') {
            $this->dropForeignColumnCallback($name); 
        });
        // Zone blueprint
        Blueprint::macro('zone', function($name = 'zone_id') {
            return $this->createForeignColumnCallback($name, 'location_zones');
        });
        Blueprint::macro('dropZone', function($name = 'zone_id') {
            $this->dropForeignColumnCallback($name); 
        });
    }

    /**
     * Returns callback for bluprint column denifion.
     * 
     * @param  string $column  
     * @param  string $table 
     * @return callable        
     */
    public function createForeignColumnCallback(string $column, string $table)
    {
        return tap($this->unsignedBigInteger($column), function($bluprint) use ($column, $table) { 
            $bluprint->index();

            $this
                ->foreign($column)->references('id')->on($table);
        }); 
    }

    /**
     * Returns callback for bluprint column drop.
     * 
     * @param  string $column   
     * @return callable        
     */
    public function dropForeignColumnCallback(string $column)
    {
        return function($column) {
            $this->dropForeign($this->createIndexName('foreign', $column));
            $this->dropColumn($column); 
        };
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    } 

    /**
     * Get the events that trigger this service provider to register.
     *
     * @return array
     */
    public function when()
    {
        return [
            \Laravel\Nova\Events\ServingNova::class,
            \Illuminate\Console\Events\ArtisanStarting::class
        ];
    }
}

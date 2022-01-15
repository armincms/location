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
        Models\LocationCountry::class =>  Policies\Country::class, 
        Models\LocationState::class =>  Policies\State::class, 
        Models\LocationCity::class =>  Policies\City::class, 
        Models\LocationZone::class =>  Policies\Zone::class, 
    ]; 

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->resources(); 
        $this->registerPolicies();
        $this->registerBlueprintMacros();
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
    }

    /**
     * Register any nova services.
     *  
     * @return void
     */
    public function resources()
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
            return $this->createForeignColumnCallback($name, 'location_cities');
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
        // Returns callback for bluprint column denifion.
        Blueprint::macro('createForeignColumnCallback', function($column, $table) {
            return tap($this->foreignId($column), function($column) use ($table) {
                $column->index()->constrained($table);
            });
        }); 
        // Returns callback for bluprint column drop.
        Blueprint::macro('dropForeignColumnCallback', function($column) { 
            return function($column) {
                $this->dropForeign($this->createIndexName('foreign', $column));
                $this->dropColumn($column); 
            }; 
        }); 
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

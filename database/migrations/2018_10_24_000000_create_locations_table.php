<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Armincms\Location\Nova\Country;
use Armincms\Location\Nova\State;
use Armincms\Location\Nova\City;
use Armincms\Location\Location;

class CreateLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    { 
        Schema::create('locations', function (Blueprint $table) {
            $table->bigIncrements('id');  
            $table->string('iso')->nullable(); 
            $table->boolean('active')->default(false);  
            $table->boolean('capital')->default(false); 
            $table->string('resource')
                  ->default("Armincms\\\\Location\\\\Nova\\\\City"); 
            $table->unsignedBigInteger('location_id')->nullable()->index(); 
            $table->coordinates(); 
            $table->config();  

            $table
                ->foreign('location_id', 'parent_location_foregin_id')
                ->references('id')->on('locations')
                ->onUpdate('cascade')
                ->onDelete('cascade');   
        });  

        // $this->insertCountires(); 
    }

    public function insertCountires()
    { 
        $json = json_decode(\File::get(__DIR__.'/countries.json')); 

        $countries = collect($json->countries)->map(function($country) { 
            return [
                'id' => (int) $country->id,
                'iso'=> $country->sortname,
                'resource' => "Armincms\\Location\\Nova\\Country",
                'config' => collect([
                    'phoneCode' => $country->phoneCode
                ])
            ];
        });

        Location::insert($countries->values()->all());
    } 

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('locations');
    }
}

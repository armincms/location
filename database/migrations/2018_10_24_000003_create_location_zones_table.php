<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration; 

class CreateLocationZonesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    { 
        Schema::create('location_zones', function (Blueprint $table) {
            $table->id();   
            $table->json('name');  
            $table->boolean('active')->default(false);  
            $table->foreignId('city_id')->constrained('location_cities');  
            $table->string('latitude', 20)->nullable();
            $table->string('longitude', 20)->nullable(); 
            $table->softDeletes();   
        });   
    } 

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('location_zones');
    }
}

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
            $table->bigIncrements('id');   
            $table->json('name')->nullable();  
            $table->boolean('active')->default(false);  
            $table->unsignedBigInteger('city_id');  
            $table->decimal('latitude', 9, 6)->nullable();
            $table->decimal('longitude', 9, 6)->nullable(); 
            $table->softDeletes();  

            $table
                ->foreign('city_id')
                ->references('id')->on('location_cities')
                ->onDelete('cascade') 
                ->onUpdate('cascade'); 
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

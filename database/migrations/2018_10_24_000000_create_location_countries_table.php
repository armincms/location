<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration; 

class CreateLocationCountriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    { 
        Schema::create('location_countries', function (Blueprint $table) {
            $table->bigIncrements('id');  
            $table->json('name')->nullable(); 
            $table->string('iso')->nullable(); 
            $table->boolean('active')->default(false);   
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
        Schema::dropIfExists('location_countries');
    }
}

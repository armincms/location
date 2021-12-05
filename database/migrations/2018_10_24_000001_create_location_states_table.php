<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration; 

class CreateLocationStatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    { 
        Schema::create('location_states', function (Blueprint $table) {
            $table->id();   
            $table->json('name');  
            $table->boolean('active')->default(false);  
            $table->foreignId('country_id')->constrained('location_countries');  
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
        Schema::dropIfExists('location_states');
    }
}

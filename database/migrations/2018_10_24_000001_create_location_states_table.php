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
            $table->bigIncrements('id');   
            $table->json('name')->nullable();  
            $table->boolean('active')->default(false);  
            $table->unsignedBigInteger('country_id');  
            $table->softDeletes();  

            $table
                ->foreign('country_id')
                ->references('id')->on('location_countries')
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
        Schema::dropIfExists('location_states');
    }
}

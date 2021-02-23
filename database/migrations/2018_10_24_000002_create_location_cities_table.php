<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration; 

class CreateLocationCitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    { 
        Schema::create('location_cities', function (Blueprint $table) {
            $table->bigIncrements('id');   
            $table->json('name')->nullable();  
            $table->boolean('active')->default(false);  
            $table->unsignedBigInteger('state_id');  
            $table->softDeletes();  

            $table
                ->foreign('state_id')
                ->references('id')->on('location_states')
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
        Schema::dropIfExists('location_cities');
    }
}

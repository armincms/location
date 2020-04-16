<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLocatablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    { 
        Schema::create('locatables', function (Blueprint $table) {
            $table->bigIncrements('id'); 
            $table->unsignedBigInteger('location_id'); 
            $table->morphs('locatable'); 

            $table
                ->foreign('location_id')->references('id')->on('locations')   
                ->onUpdate('cascade')
                ->onDelete('cascade'); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('locatables');
    }
}

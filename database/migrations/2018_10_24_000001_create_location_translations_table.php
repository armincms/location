<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLocationTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    { 
        Schema::create('location_translations', function (Blueprint $table) {
            $table->bigIncrements('id'); 
            $table->resource();

            $table->unsignedBigInteger('location_id');
 
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
        Schema::dropIfExists('location_translations');
    }
}

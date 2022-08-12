<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('organisation');
            $table->string('property_type');
            //not sure if this links to its own table or non existing table 
            $table->bigInteger('parent_property_id')->unsigned()->nullable();
       
            $table->string('uprn');
            $table->string('address');
            $table->string('town');
            $table->string('postcode');
            //assume that its just on or off
            $table->boolean('live');
            $table->softDeletes();

            $table->timestamps();
        });
        // because its self referencing you need create table then ref it.
        Schema::table('properties', function (Blueprint $table) {
            $table->foreign('parent_property_id')->references('id')->on('properties')->onDelete('cascade');     
        });        

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('properties');
    }
}

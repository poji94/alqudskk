<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItinerariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('itineraries', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('option1_pickup_place');
            $table->string('option1_pickup_time');
            $table->string('option1_dropoff_place');
            $table->string('option1_dropoff_time');
            $table->string('option2_pickup_place');
            $table->string('option2_pickup_time');
            $table->string('option2_dropoff_place');
            $table->string('option2_dropoff_time');
            $table->text('description');
            $table->string('duration');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('itineraries');
    }
}

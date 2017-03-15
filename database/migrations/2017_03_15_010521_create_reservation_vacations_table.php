<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReservationVacationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservation_vacations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('reservation_id');
            $table->integer('reservable_id');
            $table->string('reservable_type');
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
        Schema::drop('reservation_vacations');
    }
}

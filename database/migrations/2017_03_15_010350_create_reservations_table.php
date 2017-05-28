<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('reservation_type_id');
            $table->string('main_reservation_start');
            $table->string('main_reservation_end');
            $table->string('alternate_reservation_start');
            $table->string('alternate_reservation_end');
            $table->string('chosen_date');
            $table->integer('children_no');
            $table->integer('adult_no');
            $table->string('price_type');
            $table->integer('price');
            $table->integer('reservation_status_id');
            $table->text('other_details');
            $table->text('remarks');
            $table->integer('remarks_by');
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
        Schema::drop('reservations');
    }
}

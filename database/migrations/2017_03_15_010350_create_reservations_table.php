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
            $table->string('reservation_start');
            $table->string('reservation_end');
            $table->integer('children_no');
            $table->integer('adult_no');
            $table->string('price_type');
            $table->integer('price');
            $table->integer('reservation_status_id');
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

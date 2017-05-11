<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePriceTourismsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('price_tourisms', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('personal');
            $table->integer('private_group_adult')->unsigned();
            $table->integer('private_group_children')->unsigned();
            $table->integer('public_group_adult')->unsigned();
            $table->integer('public_group_children')->unsigned();
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
        Schema::drop('price_tourisms');
    }
}

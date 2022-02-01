<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Trips extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'trips', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('compId');
            $table->string('from');
            $table->string('to');
            $table->integer('numSeats');
            $table->timestamp('time');
            $table->integer('priceASeat');
            $table->string('status');
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
        //
    }
}

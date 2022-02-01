<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Passenger extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'passenger', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('fName');
            $table->string('lName');
            $table->integer('phone')->unique();
            $table->integer('idn')->unique();
            $table->string('password');
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

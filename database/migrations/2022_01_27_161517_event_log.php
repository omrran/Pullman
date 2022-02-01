<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EventLog extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'eventslog', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('eventType');
            $table->string('subjectId');//id of company or passenger
            $table->string('objectId'); //id of trip or post
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

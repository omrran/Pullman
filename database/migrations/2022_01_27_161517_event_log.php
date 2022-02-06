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
            'eventsLog', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('eventType',25);
            $table->string('actorType',10);
            $table->unsignedInteger('actorId');
            $table->string('objectType');
            $table->unsignedInteger('objectId');
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

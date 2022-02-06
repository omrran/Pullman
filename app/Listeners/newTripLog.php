<?php

namespace App\Listeners;

use App\Events\addNewTrip;
use App\Models\EventLog;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Session;

class newTripLog
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param object $event
     * @return void
     */
    public function handle(addNewTrip $event)
    {
        EventLog::create([
            'eventType' => $event->eventType,
            'actorType' => $event->actorType,
            'actorId' => $event->actorId,
            'objectType' => $event->objectType,
            'objectId' => $event->objectId
        ]);
    }
}

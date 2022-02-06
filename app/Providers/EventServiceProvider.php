<?php

namespace App\Providers;

use App\Events\addNewPost;
use App\Events\addNewTrip;
use App\Events\reserveASeat;
use App\Listeners\newPostLog;
use App\Listeners\newReservationLog;
use App\Listeners\newTripLog;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        addNewTrip::class => [
            newTripLog::class,
        ],
        addNewPost::class => [
            newPostLog::class,
        ],
        reserveASeat::class => [
            newReservationLog::class,
        ],

    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}

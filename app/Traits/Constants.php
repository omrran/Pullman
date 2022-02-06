<?php


namespace App\Traits;


class Constants
{
    //default image name for new passenger
    const PASSENGER_IMAGE_NAME = 'passenger_account.jpg';
    //default image name for new company
    const COMPANY_IMAGE_NAME = 'company_account.jpg';
    const PASSENGER_STATUS = [
        'BLOCKED' => 'blocked',
        'UNBLOCKED' => 'unblocked'
    ];
    const EVENT_TYPE = [
        'NEW_TRIP' => 'newTrip',
        'NEW_POST' => 'newPost',
        'RESERVE_TRIP' => 'reserveTrip'
    ];
    const ACTOR_TYPE = [
        'PASSENGER' => 'passenger',
        'COMPANY' => 'company',
    ];
    const OBJECT_TYPE = [
        'POST' => 'post',
        'TRIP' => 'trip',
        'RESERVE' => 'reserve',
    ];


    const COMPANY_STATUS = [
        'PENDING' => 'pending',
        'BLOCKED' => 'blocked',
        'UNBLOCKED' => 'unblocked'
    ];


    //this value is used in oldTrips.blade.php
    const TRIP_STATUS = [
        'OPEN' => 'open',
        'CLOSED' => 'closed',
        'GONE' => 'gone'
    ];





}

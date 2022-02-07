@extends('A_master')

@section('title')
    <title>what is PULLMAN</title>
@endsection

@section('content')

    <x-navbar/>

    <div class="container fs-4 font-monospace border-start border-primary border-5 mt-3 bg-warning">

        A website that provides an online reservation service for transport companies that are registered on the
        website.<br>
        This website allows transport companies to register an official and trusted account, advertise their trips and
        receive
        passenger reservations electronically.<br><br>
        It also allows people to register passenger accounts so that they are reliable.<br><br>

        This website supports the registration of three types of accounts with different roles: <br>
        <strong class="text-white">- Admin account:</strong> <br>
        It is the website supervisor in general , It has the following permissions: <br>
        <ul style="margin-left: 50px">
            <li>
                Show all the companies registered in the system.
            </li>
            <li>
                Show all the passengers registered in the system.
            </li>
            <li>
                Activate new companies account.
            </li>
            <li>
                Block company.
            </li>
            <li>
                Unblock company.
            </li>
            <li>
                Block passenger.
            </li>
            <li>
                Unblock passenger.
            </li>
            <li>
                show Events log.
            </li>
        </ul>
        <strong class="text-white">- Company account:</strong> <br>
        It has the following permissions: <br>
        <ul style="margin-left: 50px">
            <li>
                Register an account .
            </li>
            <li>
                Add new trip.
            </li>
            <li>
                Show all trips with filter.
            </li>
            <li>
                View profile.
            </li>
            <li>
                Edit profile.
            </li>
            <li>
                Add new post.
            </li>
            <li>
                Show activity log.
            </li>
        </ul>

        <strong class="text-white">- Passenger account:</strong> <br>
        It has the following permissions: <br>
        <ul style="margin-left: 50px">
            <li>
                Register an account .
            </li>
            <li>
                Show all the companies registered in the system.
            </li>
            <li>
                Reserve in a trip.
            </li>
            <li>
                Add new post.
            </li>
            <li>
                View profile.
            </li>
            <li>
                Edit profile.
            </li>
            <li>
                Show activity log.
            </li>
        </ul>


    </div>

@endsection

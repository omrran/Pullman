@extends('passenger.passengerProfile')

@section('main content')
    <div class="text-center alert-primary pt-1 pb-1 sidebar-custom-item "><a href="/passenger-profile/trip/{{$myReservation->tripId}}">{{$myReservation->compName}} at : {{$myReservation->time}}</a> </div>
@endsection

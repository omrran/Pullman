@extends('passenger.passengerProfile')

@section('main content')

    <x-trip
        id="{{$trip->id}}"
        from="{{$trip->from}}"
        to="{{$trip->to}}"
        numSeats="{{$trip->numSeats}}"
        price="{{$trip->priceASeat}}"
        time="{{$trip->time}}"
        companyName="{{$trip->company->compName}}"
    />
@endsection

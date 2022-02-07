@extends('company.companyProfile')

@section('main content')

    <x-trip
        id="{{$trip->id}}"
        from="{{$trip->from}}"
        to="{{$trip->to}}"
        numSeats="{{$trip->numSeats}}"
        price="{{$trip->priceASeat}}"
        time="{{$trip->time}}"
        creationDate="{{$trip->created_at}}"
        companyName="{{$trip->company->compName}}"
        companyImage="{{$trip->company->imagePath}}"
    />@endsection

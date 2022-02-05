@extends('passenger.passengerProfile')

@section('main content')

    <div class="m-auto p-3  border rounded-bottom rounded-circle bg-blue text-light">
        News
    </div>
    <div class=" w-100 mx-auto border border-primary border-3 rounded-3 p-2 d-flex flex-wrap  ">

        @foreach($openTrips as $trip)
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
            />
        @endforeach

        @foreach($companyPosts as $post)
            <x-post postContent="{{$post->content}}"
                    publisherName="{{$post->company->compName}}"
                    publisherImage="{{$post->company->imagePath}}"
                    postTime="{{$post->created_at}}"
            />
        @endforeach

        @foreach($passengerPosts as $post)
            <x-post postContent="{{$post->content}}"
                    publisherName="{{$post->passenger->fName}} {{$post->passenger->lName}}"
                    publisherImage="{{$post->passenger->imagePath}}"
                    postTime="{{$post->created_at}}"/>
        @endforeach





    </div>
@endsection

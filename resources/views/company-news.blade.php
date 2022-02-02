@extends('companyProfile')

@section('main content')

    <div class="m-auto p-3  border rounded-bottom rounded-circle bg-blue text-light">
        News
    </div>
    <div class=" w-100 mx-auto border border-primary border-3 rounded-3 p-2 d-flex flex-column justify-content-center ">

        @foreach($openTrips as $trip)
            <x-trip
                id="{{$trip->id}}"
                from="{{$trip->from}}"
                to="{{$trip->to}}"
                numSeats="{{$trip->numSeats}}"
                price="{{$trip->priceASeat}}"
                time="{{$trip->time}}"
                companyName="{{$trip->company->compName}}"
            />
        @endforeach

        @foreach($companyPosts as $post)
            <x-post postContent="{{$post->content}}"
                    companyName="{{$post->company->compName}}"
                    postTime="{{$post->created_at}}"
            />
        @endforeach

        @foreach($passengerPosts as $post)
            <x-post postContent="{{$post->content}}"
                    companyName="{{$post->passenger->fName}}"
                    postTime="{{$post->created_at}}"/>
        @endforeach





    </div>
@endsection

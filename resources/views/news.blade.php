@extends('companyProfile')

@section('main content')

    <div class="m-auto p-3  border rounded-bottom rounded-circle bg-blue text-light">
        News
    </div>
    <div class=" w-100 mx-auto border border-primary border-3 rounded-3 p-2 d-flex flex-wrap justify-content-center ">

        @foreach($companyPosts as $post)
            <x-post postContent="{{$post->content}}"
                    companyName="{{$post->company->compName}}"
                    postTime="{{$post->created_at}}"
            />
        @endforeach

        @foreach($passengerPosts as $post)
            <x-post postContent="{{$post->content}}"
                    companyName="{{$post->company->compName}}"
                    postTime="{{$post->created_at}}"/>
        @endforeach

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



    </div>
@endsection

@extends('passenger.passengerProfile')

@section('main content')
    <x-post postContent="{{$post->content}}"
            publisherName="{{$post->passenger->fName}} {{$post->passenger->lName}}"
            publisherImage="{{$post->passenger->imagePath}}"
            postTime="{{$post->created_at}}"
    />
@endsection

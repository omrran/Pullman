@extends('admin.adminProfile')

@section('main content')

    @if($pageName =='Company Post')
        <x-post postContent="{{$post->content}}"
                publisherName="{{$post->company->compName}}"
                publisherImage="{{$post->company->imagePath}}"
                postTime="{{$post->created_at}}"
        />

    @elseif($pageName =='Passenger Post')
        <x-post postContent="{{$post->content}}"
                publisherName="{{$post->passenger->fName}} {{$post->passenger->lName}}"
                publisherImage="{{$post->passenger->imagePath}}"
                postTime="{{$post->created_at}}"
        />
    @endif

@endsection

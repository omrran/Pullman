@extends('company.companyProfile')

@section('main content')

    <x-post postContent="{{$post->content}}"
            publisherName="{{$post->company->compName}}"
            publisherImage="{{$post->company->imagePath}}"
            postTime="{{$post->created_at}}"
    />
@endsection

@extends('A_master')

@section('title')
    <title>Home</title>
@endsection

@section('content')

    <x-navbar/>
    <div class="content">
        <img src="{{URL('photos/bus.png')}}" width='100%' height="560px">
    </div>


@endsection

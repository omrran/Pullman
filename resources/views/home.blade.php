@extends('A_master')

@section('title')
    <title>Home</title>
@endsection

@section('content')

    <x-navbar/>
    <div class="content">
        <img src="{{URL('photos/bus.png')}}" width='100%' height="560px">
    </div>
    <div style="height: 450px;background-color :rgb(58, 56, 56); color:rgb(0, 0, 0)">
        
        <div class="container bg-white fs-2 border-start border-warning border-5">
            about us
        </div>
    </div>
    <div  style="height: 175px;background-color :black; color:rgb(0, 0, 0)">
        
        <div class="container bg-white fs-2 border-start border-warning border-5 rounded-end ">
            contact us
        </div>
    </div>

@endsection

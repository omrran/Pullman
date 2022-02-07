@extends('A_master')

@section('title')
    <title>Companies</title>
    <style>
        body{
            background-color: #fdbe8a;
        }
    </style>
@endsection

@section('content')
    {{--    @include('navbar')--}}
    <x-navbar/>
    <div class="d-flex justify-content-center flex-wrap">
        @foreach($companies as $company)
        <x-company photo="{{$company->imagePath}}" name="{{$company->compName}}" address="{{$company->address}}" telephone="{{$company->telephone}}"/>
        @endforeach
    </div>

@endsection

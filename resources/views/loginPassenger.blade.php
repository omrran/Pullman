@extends('A_master')

@section('title')<title>Login Passenger</title>@endsection

@section('content')


<x-navbar />

<div class="container d-flex p-5 flex-column justify-content-center bd-highlight ">
    @if(Session::has('Success'))
    <div class="alert alert-success">
        <strong>Nice!</strong> The registration process on the site has been completed .. you can log in now
    </div>
    @endif
    <div id="titleForm" class="m-auto p-3  border rounded-bottom rounded-circle bg-blue text-light">
        Passenger
    </div>
    <form class="bg-white w-50 border border-primary border-3 rounded-3 p-2 m-auto" action="{{url('/passenger-page')}}"
        method="POST">
        @csrf
        <div class="mb-3 ">
            <label class="form-label">Phone Number :</label>
            @error('phone')
            <small class="text-danger">{{$message}}</small>
            @enderror
            <input type="text" class="form-control" name="phone" aria-describedby="emailHelp">
        </div>


        <div class="mb-3 ">
            <label class="form-label">Password :</label>
            @error('password')
            <small class="text-danger">{{$message}}</small>
            @enderror
            @if(Session::has('PasswordFailed'))
            <small class="text-danger">{{Session::get('PasswordFailed')}}</small>
            @endif
            <input type="password" class="form-control" name="password" aria-describedby="emailHelp">
        </div>

        <button type="submit" class="btn btn-primary w-25 ">log in</button>
    </form>

</div>

@endsection

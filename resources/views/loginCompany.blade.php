@extends('A_master')

@section('title')<title>Login Company</title>@endsection

@section('content')

<x-navbar />

<div class="container d-flex p-5 flex-column justify-content-center bd-highlight ">
    @if(Session::has('Success'))
    <div class="alert alert-success mx-auto">
        <strong>Nice!</strong> Your request has been sent to the admin, and it is not possible to log in without approval of your request
    </div>
    @endif
    @if(Session::has('pendingAccount'))
           <div class="alert alert-success mx-auto">
               <strong>Ops!</strong> {{Session::get('pendingAccount')}}
           </div>
    @endif
    <div class="m-auto p-3  border rounded-bottom rounded-circle bg-blue text-light">
        Company
    </div>
    <form class="bg-white w-50 border border-primary border-3 rounded-3 p-2 m-auto" action="{{url('/company-page')}}"
        method="POST">
        @csrf

        <div class="mb-3 ">
            <label class="form-label">Email :</label>
            @error('email')
            <small class="text-danger">{{$message}}</small>
            @enderror
            <input type="text" class="form-control" name="email" aria-describedby="emailHelp">
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

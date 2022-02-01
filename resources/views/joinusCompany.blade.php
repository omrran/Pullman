@extends('A_master')

@section('title')
<title>joinUs Company</title>
@endsection



@section('content')


<x-navbar />
{{-- <div class="whatpullman">--}}

    {{-- @if(Session::has('EmailFailed'))--}}
    {{-- <h1>{{Session::get('EmailFailed')}}</h1>--}}
    {{-- @endif--}}
    {{-- <div id="titleForm" class="title-form">Company</div>--}}

    {{-- <form id="company" action="{{url('/join-company')}}" method="POST">--}}
        {{-- @csrf--}}
        {{-- <label>Company Name</label>--}}
        {{-- @error('compName')--}}
        {{-- <small id="compNameError" class="error">{{$message}}</small>--}}
        {{-- @enderror--}}
        {{-- <br>--}}
        {{-- <input class="field" name="compName" type="text" value="{{old('compName')}}" /><br>--}}


        {{-- <label>Email</label>--}}
        {{-- @error('email')--}}
        {{-- <small id="compNameError" class="error">{{$message}}</small>--}}
        {{-- @enderror--}}
        {{-- <br>--}}
        {{-- <input class="field" name="email" type="text" value="{{old('email')}}" /><br>--}}

        {{-- <label>Telephone Number</label>--}}
        {{-- @error('telephone')--}}
        {{-- <small id="compNameError" class="error">{{$message}}</small>--}}
        {{-- @enderror--}}
        {{-- <br>--}}
        {{-- <input class="field" name="telephone" type="text" /><br>--}}

        {{-- <label>Address</label>--}}
        {{-- @error('address')--}}
        {{-- <small id="compNameError" class="error">{{$message}}</small>--}}
        {{-- @enderror--}}
        {{-- <br>--}}
        {{-- <input class="field" name="address" type="text" /><br>--}}

        {{-- <label>Password</label>--}}
        {{-- @error('password')--}}
        {{-- <small id="compNameError" class="error">{{$message}}</small>--}}
        {{-- @enderror--}}
        {{-- <br>--}}
        {{-- <input class="field" name="password" type="password" /><br><br>--}}

        {{-- <button class="submit" type="submit">Join Us</button>--}}
        {{-- </form>--}}

    {{-- </div>--}}
{{--//new form//////////////////////////////////////////////////////////--}}
<div class="container d-flex flex-column justify-content-center bd-highlight ">
    @if(Session::has('EmailFailed'))
    <div class="alert alert-warning">
        <strong>opps! ,</strong> {{Session::get('EmailFailed')}}
    </div>
    @endif
    <div id="titleForm" class="m-auto p-3  border rounded-bottom rounded-circle bg-blue text-light">
        Company
    </div>
    <form class="bg-white w-50 border border-primary border-3 rounded-3 p-2 m-auto" action="{{url('/join-company')}}"
        method="POST">
        @csrf
        <div class="mb-3">
            <label class="form-label">Company Name</label>
            @error('compName')
            <small id="compNameError" class="text-danger">{{$message}}</small>
            @enderror
            <input type="text" class="form-control" name="compName" value="{{old('compName')}}" aria-describedby="emailHelp">
        </div>

        <div class="mb-3">
            <label class="form-label">Email</label>
            @error('email')
            <small id="compNameError" class="text-danger">{{$message}}</small>
            @enderror
            <input type="text" class="form-control" name="email">
        </div>

        <div class="mb-3">
            <label class="form-label">Telephone Number</label>
            @error('telephone')
            <small id="compNameError" class="text-danger">{{$message}}</small>
            @enderror
            <input type="text" class="form-control" name="telephone">
        </div>



        <div class="mb-3">
            <label class="form-label">Address</label>
            @error('address')
            <small class="text-danger">{{$message}}</small>
            @enderror
            <input type="text" class="form-control" name="address">
        </div>

        <div class="mb-3">
            <label class="form-label">Password</label>
            @error('password')
            <small class="text-danger">{{$message}}</small>
            @enderror
            <input type="password" class="form-control" name="password">
        </div>

        <button type="submit" class="btn btn-primary w-25 ">Join Us</button>
    </form>

</div>
@endsection
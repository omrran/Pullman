@extends('A_master')

@section('title')
    <title>joinUs Passenger</title>
@endsection



@section('content')

    {{--    @include('navbar')--}}
    <x-navbar/>

    <div class="container d-flex flex-column justify-content-center bd-highlight ">
        @if(Session::has('EmailFailed'))
            <div class="alert alert-warning">
                <strong>opps! ,</strong> {{Session::get('EmailFailed')}}
              </div>
        @endif
        <div id="titleForm" class="m-auto p-3  border rounded-bottom rounded-circle bg-blue text-light">
            Passenger
        </div>
        <form class="bg-white w-50 border border-primary border-3 rounded-3 p-2 m-auto" action="{{url('/join-passenger')}}" method="POST">
            @csrf
            <div class="mb-3">
                <label  class="form-label">First Name</label>
                @error('fName')
                <small  class="text-danger">{{$message}}</small>
                @enderror
                <input type="text" class="form-control"  name="fName" aria-describedby="emailHelp">
            </div>

            <div class="mb-3">
                <label  class="form-label">Last Name</label>
                @error('lName')
                <small  class="text-danger">{{$message}}</small>
                @enderror
                <input type="text" class="form-control"  name="lName" aria-describedby="emailHelp">
            </div>


            <div class="mb-3">
                <label  class="form-label">Phone Number :</label>
                @error('phone')
                <small  class="text-danger">{{$message}}</small>
                @enderror
                <input type="text" class="form-control" name="phone" >
            </div>



            <div class="mb-3">
                <label class="form-label">ID :</label>
                @error('idn')
                <small  class="text-danger">{{$message}}</small>
                @enderror
                <input type="text" class="form-control" name="idn" >
            </div>

            <div class="mb-3">
                <label class="form-label">Password</label>
                @error('password')
                <small  class="text-danger">{{$message}}</small>
                @enderror
                <input type="password" class="form-control" name="password" >
            </div>

            <button type="submit" class="btn btn-primary w-25 ">Join Us</button>
        </form>

    </div>
@endsection

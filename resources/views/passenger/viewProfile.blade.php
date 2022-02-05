@extends('passenger.passengerProfile')

@section('main content')
    @if(Session::has('pass_profile_edit_done'))
        <div class="alert alert-primary">
            {{\Illuminate\Support\Facades\Session::get('pass_profile_edit_done')}}
        </div>
    @endif
    @if(Session::has('failed_phone'))
        <div class="alert alert-primary">
            {{\Illuminate\Support\Facades\Session::get('failed_phone')}}
        </div>
    @endif
    @if(Session::has('failed_idn'))
        <div class="alert alert-primary">
            {{\Illuminate\Support\Facades\Session::get('failed_idn')}}
        </div>
    @endif

    <div class="w-95 bg-custom-gray mx-auto p-1 d-flex rounded-3 mt-3">
        <div class="w-25  p-1 pt-2 bg-secondary " style="border-radius: 0 80px 0 0 ">
            <img width="150" height="150"  class="rounded-circle " src="{{asset('photos/'.$passenger->imagePath)}}">
        </div>
        <div class="w-75  text-start p-3 ">
            <div class="mb-2 mt-2"><strong>First Name : </strong>{{$passenger->fName}} </div>
            <div class="mb-2 mt-2"><strong>Last Name : </strong>{{$passenger->lName}}</div>
            <div class="mb-2 mt-2"><strong>Phone Number : </strong>{{$passenger->phone}}</div>
            <div class="mb-2 mt-2"><strong>IDN  :</strong> {{$passenger->idn}}</div>
            <hr class="m-0">
            <div class="btn btn-primary  p-0 px-1" onclick="window.location='{{ url("/passenger-profile/edit-profile") }}'"> Edit Profile</div>
        </div>
    </div>



@endsection

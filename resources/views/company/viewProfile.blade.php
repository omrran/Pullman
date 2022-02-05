@extends('company.companyProfile')

@section('main content')


    @if(Session::has('comp_profile_edit_done'))
        <div class="alert alert-primary">
            {{\Illuminate\Support\Facades\Session::get('comp_profile_edit_done')}}
        </div>
    @endif
    @if(Session::has('failed_telephone'))
        <div class="alert alert-primary">
            {{\Illuminate\Support\Facades\Session::get('failed_telephone')}}
        </div>
    @endif
    @if(Session::has('failed_email'))
        <div class="alert alert-primary">
            {{\Illuminate\Support\Facades\Session::get('failed_email')}}
        </div>
    @endif

    <div class="w-95 bg-custom-gray mx-auto p-1 d-flex rounded-3 mt-3">
        <div class="w-25  p-1 pt-2 bg-secondary " style="border-radius: 0 80px 0 0 ">
            <img width="150" height="150"  class="rounded-circle " src="{{asset('photos/'.$company->imagePath)}}">
        </div>
        <div class="w-75  text-start p-3 ">
            <div class="mb-2 mt-2"><strong>Company Name : </strong>{{$company->compName}} </div>
            <div class="mb-2 mt-2"><strong>Email : </strong>{{$company->email}}</div>

            <div class="mb-2 mt-2"><strong>Telephone Number : </strong>{{$company->telephone}}</div>

            <div class="mb-2 mt-2"><strong>Address  :</strong> {{$company->address}}</div>
            <hr class="m-0">
            <div class="btn btn-primary  p-0 px-1" onclick="window.location='{{ url("/company-profile/edit-profile") }}'"> Edit Profile</div>
        </div>
    </div>


@endsection

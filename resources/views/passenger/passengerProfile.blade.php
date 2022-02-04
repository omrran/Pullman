@extends('A_master')

@section('title')<title>Passenger Profile</title>@endsection

@section('content')


    <x-navbar />
        <div class="container mt-2  ">
            <div class="row">
                <div class="col-12 col-lg-9 text-center  border-primary p-0">
                    <div class="d-flex justify-content-around  border border-secondary border-custom-nav bg-body" style="height: 40px">
                        <div class="pt-2 sidebar-custom-item fst-italic fw-bold"><a href="/passenger-profile/news">News</a></div>
                        <div class="pt-2 sidebar-custom-item fst-italic fw-bold"><a href="/passenger-profile/write-post">Write A Post</a></div>

                    </div>
                    <div class="d-flex flex-column  mt-2 mx-2">
                        @yield('main content')
                    </div>

                </div>
                <div class="col-12 col-lg-3 text-center p-0  ">
                    <div class="bg-dark w-100 text-white fs-4 rounded-pill-right-custom" style="height: 40px">
                        Passenger Profile
                    </div>
                    <div class="p-2  d-flex flex-column justify-content-start border border-secondary border-custom-side d-flex flex-column justify-content-start bg-body">
                        <div class="d-flex flex-column ">
                            <img width="125" height="125"  class="rounded-circle img-thumbnail m-auto" src="{{asset('photos/'.$passenger->imagePath)}}">
                            <h5>{{$passenger->fName}} {{$passenger->lName}}</h5>
                        </div>
                        <div class=" border border-secondary m-auto  rounded-pill view-custom-pro  px-5"><a href="/passenger-profile/view-profile">view profile</a> </div>
                        <hr class="m-2 "/>
                        <div class="text-start">My Reservations :</div>
                        @foreach($myReservations as $reserve)
                            <div class="text-center sidebar-custom-item "><a href="/passenger-profile/trip/{{$reserve->tripId}}">{{$reserve->compName}} at : {{$reserve->time}}</a> </div>
                        @endforeach
                        <hr class="m-2 "/>
                        <div class="text-start sidebar-custom-item p-1"><a href="#">Activity Log</a> </div>
                        <hr class="m-2 "/>
                        <div class="text-start sidebar-custom-item p-1"><a href="/passenger-profile/log-out-pass">Log out</a> </div>

                    </div>
                </div>
            </div>

        </div>

@endsection

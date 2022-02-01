@extends('A_master')

@section('title')
    <title>Company Profile</title>
@endsection

@section('content')


    <x-navbar/>
    <div class="container mt-2  ">
        <div class="row">
            <div class="col-12 col-lg-9   border-primary p-0">
                <div class="d-flex justify-content-around  border border-secondary border-custom-nav bg-body"
                     style="height: 40px">
                    <div class="pt-2 sidebar-custom-item fst-italic fw-bold "><a href="/company-profile/news">News</a>
                    </div>
                    <div class="pt-2 sidebar-custom-item fst-italic fw-bold"><a href="/company-profile/write-post">Write
                            A Post</a></div>
                    <div class="pt-2 sidebar-custom-item fst-italic fw-bold"><a href="/company-profile/trip-form">New
                            Trip</a></div>
                    <div class="pt-2 sidebar-custom-item fst-italic fw-bold"><a href="/company-profile/old-trips">Old
                            Trips</a></div>
                </div>
                <div class="d-flex flex-column  mt-2 mx-2">

                    @yield('main content')
                </div>

            </div>

            <div class="col-12 col-lg-3 text-center p-0 shadow ">

                <div class="bg-dark w-100 text-white fs-4 rounded-pill-right-custom" style="height: 40px">
                        Company Profile
                        Passenger Profile
                </div>
                <div
                    class="p-2  d-flex flex-column justify-content-start border border-secondary border-custom-side d-flex flex-column justify-content-start bg-body">
                    <div class="d-flex flex-column ">
                        <img width="125" height="125" class="rounded-circle img-thumbnail m-auto"
                             src="{{asset('photos/111.jpg')}}">
                        <h5>{{$company->compName}}</h5>
                    </div>
                    <div class=" border border-secondary m-auto  rounded-pill view-custom-pro  px-5"><a href="#">view
                            profile</a></div>
                    <hr class="m-2 "/>
                    <div class="text-start sidebar-custom-item p-1"><a href="#">Activity Log</a></div>
                    <hr class="m-2 "/>
                    <div class="text-start sidebar-custom-item p-1"><a href="/company-profile/log-out-comp">Log out</a>
                    </div>

                </div>
            </div>
        </div>

    </div>

@endsection

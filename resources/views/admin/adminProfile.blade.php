@extends('A_master')

@section('title')<title>Admin Profile</title>@endsection

@section('content')

    <div class="container mt-2 ">
        <div class="row">
            <div class="col-12 col-lg-9 text-center  border-primary p-0 ">
                <div class="fw-bold pt-2 d-flex justify-content-around  bg-custom-gray border border-secondary border-custom-nav " style="height: 40px">
                    {{$pageName}}
                </div>
                <div class="d-flex flex-column justify-content-center mt-2 mx-2">
                    @yield('main content')

                </div>

            </div>
            <div class="col-12 col-lg-3 text-center p-0 ">
                <x-sidebar-admin />
            </div>
        </div>

    </div>

@endsection

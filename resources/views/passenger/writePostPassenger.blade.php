@extends('passenger.passengerProfile')

@section('main content')

    <div class="m-auto p-3  border rounded-bottom rounded-circle bg-blue text-light">
        Write A Post
    </div>
    <div class=" w-100 mx-auto border border-primary border-3 rounded-3 p-2 d-flex flex-wrap justify-content-center">

        <div class="w-75 ">
            <div class="d-flex justify-content-start bg-custom-gray p-1 rounded-border-post-header-custom">
                <img class="float-start rounded-circle " src="{{asset('photos/admin.png')}}"
                     style="width: 50px;height: 50px" alt="">
                <h5 class="p-2  ">{{$passenger->fName}} {{$passenger->lName}}</h5>
            </div>
            <form action="/passenger-profile/save-post" method="post">
                @csrf
                <textarea name="post" id="" rows="10" class="w-100 border-0 m-0 h-auto "
                          placeholder="Write Any thing here.."></textarea>

                <div class=" shadow d-flex bg-custom-gray  pt-1 pb-1 negative-margin-top rounded-border-post-footer-custom w-100 ">
                    <button type="submit" class="btn btn-primary  p-0 w-50  mx-auto ">POST</button>
                </div>
            </form>

        </div>
    </div>
@endsection

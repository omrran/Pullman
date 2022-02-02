<div id="" class="bg-body  p-2 w-75  m-2 border rounded-3 m-2">
    <div class="d-flex justify-content-start  bg-white p-1 rounded-border-post-header-custom">
        <img class="float-start rounded-circle " src="{{asset('photos/admin.png')}}"
             style="width: 50px;height: 50px" alt="">
        <div class="d-flex flex-column float-start">
            <h5 class="p-2 pb-0 mb-0">{{$companyName}}</h5>
            <small class="px-1">{{$time}}</small>
        </div>
    </div>
    <h5 class="text-start text-primary">
        Trip ID : {{$id}}
    </h5>
    <hr class="m-0">
    <div>
        <p class="text-start m-2"><strong>From</strong> : {{$from}} </p>
        <p class="text-start m-2"><strong>To</strong> : {{$to}}</p>
        <p class="text-start m-2"><strong>Num Seats</strong> : {{$numSeats}}  </p>
        <p class="text-start m-2"><strong>Price A Seat</strong> : {{$price}}</p>
        <p class="text-start m-2"><strong>Time</strong> : {{$time}}</p>
    </div>
    @if(\Illuminate\Support\Facades\Session::has('LoggedPassenger'))
    <hr class="m-0">
    <div type="button" onclick=""
         class="btn btn-warning  mt-1 p-0 w-100 text-white">
        Reserve  A Seat
    </div>
    @endif
</div>

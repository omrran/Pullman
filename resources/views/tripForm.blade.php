@extends('companyProfile')

@section('main content')

    @if(Session::has('addTripDone'))
        <div class="alert alert-success mx-auto">
            <strong>Nice!</strong><a href="#" title="Go To This Trip" style="text-decoration: none"> {{Session::get('addTripDone')}}</a>
        </div>
    @endif
    @if(Session::has('addTripFailed'))
        <div class="alert alert-warning mx-auto">
            <strong>Ops!</strong> {{Session::get('addTripFailed')}}
        </div>
    @endif

    <div class="m-auto p-3  border rounded-bottom rounded-circle bg-blue text-light">
        New Trip
    </div>
    <form class="bg-white w-95 border border-primary border-3 rounded-3 p-2 m-auto" action="{{url('/company-profile/add-trip')}}"
          method="POST">
        @csrf
        <div class="row">
            <div class="col-2 ">
                <label class="form-label ">From :</label><br><br>
                <label class="form-label ">Seats :</label><br><br>
                <label class="form-label  ">Date :</label>
                @error('time') <small class="text-danger">{{$message}}</small>@enderror

            </div>
            <div class="col-4 ">
                <input type="text" class="form-control" name="from" @error('from') placeholder="{{$message}}"@enderror   aria-describedby="emailHelp"><br>
                <input type="number" class="form-control" name="numSeats" @error('numSeats') placeholder="{{$message}}"@enderror aria-describedby="emailHelp"><br>
                <input type="datetime-local" class="form-control" name="time"  aria-describedby="emailHelp">
            </div>
            <div class="col-2 ">
                <label class="form-label ">To :</label><br><br>
                <label class="form-label ">Price :</label>
            </div>
            <div class="col-4 ">
                <input type="text" class="form-control" name="to" @error('to') placeholder="{{$message}}"@enderror aria-describedby="emailHelp"><br>
                <input type="number" class="form-control" name="priceASeat" @error('price') placeholder="{{$message}}"@enderror aria-describedby="emailHelp"><br>
                <button type="submit" class="btn btn-primary w-50 float-end">Add Trip</button>

            </div>
        </div>
    </form>

@endsection

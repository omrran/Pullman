@extends('passenger.passengerProfile')

@section('main content')

    <div id="editprofile{{$passenger->id}}"  class=" mt-3 text-start" >

        <form class="bg-white w-50 border border-primary border-3 rounded-3 p-2 m-auto"
              action="{{url('/passenger-profile/save-new-profile-info')}}"
              method="POST"
              enctype="multipart/form-data"
        >
            @csrf
            <div class="mb-3">
                <label  class="form-label">First Name</label>
                @error('fName')
                <small  class="text-danger">{{$message}}</small>
                @enderror
                <input type="text" class="form-control"  name="fName" aria-describedby="emailHelp" value="{{$passenger->fName}}">
            </div>

            <div class="mb-3">
                <label  class="form-label">Last Name</label>
                @error('lName')
                <small  class="text-danger">{{$message}}</small>
                @enderror
                <input type="text" class="form-control"  name="lName" aria-describedby="emailHelp" value="{{$passenger->lName}}">
            </div>


            <div class="mb-3">
                <label  class="form-label">Phone Number :</label>
                @error('phone')
                <small  class="text-danger">{{$message}}</small>
                @enderror
                <input type="text" class="form-control" name="phone" value="{{$passenger->phone}}">
            </div>


            <div class="mb-3">
                <label class="form-label">ID :</label>
                @error('idn')
                <small  class="text-danger">{{$message}}</small>
                @enderror
                <input type="text" class="form-control" name="idn" value="{{$passenger->idn}}">
            </div>

            <div class="mb-3">
                <label for="formFileSm" class="form-label">photo</label>
                @error('photo')
                <small  class="text-danger">{{$message}}</small>
                @enderror
                <input class="form-control form-control-sm" id="formFileSm" type="file" name="photo">
            </div>

            <button type="submit" class="btn btn-primary w-25 ">Save</button>
            <div class="btn btn-secondary  " onclick="window.location='{{ url("/passenger-profile/view-profile") }}'"> cancel</div>

        </form>

    </div>
@endsection

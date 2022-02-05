@extends('company.companyProfile')

@section('main content')

    <div id="editprofile{{$company->id}}"  class=" mt-3 text-start" >

        <form class="bg-white w-50 border border-primary border-3 rounded-3 p-2 m-auto"
              action="{{url('/company-profile/save-new-profile-info')}}"
              method="POST"
              enctype="multipart/form-data"
        >
            @csrf
            <div class="mb-3">
                <label  class="form-label">Company Name</label>
                @error('compName')
                <small  class="text-danger">{{$message}}</small>
                @enderror
                <input type="text" class="form-control"  name="compName" aria-describedby="emailHelp" value="{{$company->compName}}">
            </div>

            <div class="mb-3">
                <label  class="form-label">Email</label>
                @error('email')
                <small  class="text-danger">{{$message}}</small>
                @enderror
                <input type="text" class="form-control"  name="email" aria-describedby="emailHelp" value="{{$company->email}}">
            </div>


            <div class="mb-3">
                <label  class="form-label">Telephone Number :</label>
                @error('telephone')
                <small  class="text-danger">{{$message}}</small>
                @enderror
                <input type="text" class="form-control" name="telephone" value="{{$company->telephone}}">
            </div>


            <div class="mb-3">
                <label class="form-label">Address :</label>
                @error('address')
                <small  class="text-danger">{{$message}}</small>
                @enderror
                <input type="text" class="form-control" name="address" value="{{$company->address}}">
            </div>

            <div class="mb-3">
                <label for="formFileSm" class="form-label">photo</label>
                @error('imagePath')
                <small  class="text-danger">{{$message}}</small>
                @enderror
                <input class="form-control form-control-sm" id="formFileSm" type="file" name="imagePath">
            </div>

            <button type="submit" class="btn btn-primary w-25 ">Save</button>
            <div class="btn btn-secondary  " onclick="window.location='{{ url("/company-profile/view-profile") }}'"> cancel</div>

        </form>

    </div>
@endsection

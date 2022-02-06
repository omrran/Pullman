@extends('admin.adminProfile')

@section('main content')


        @foreach($Comps as $Comp)
            <div id="{{$Comp->id}}" class="bg-body shadow-on-hover p-2 w-95 mb-1 mx-auto border rounded-3 ">
                <h5 class="text-start">Company Name : {{$Comp->compName}}</h5>
                <hr class="m-0">
                <p class="text-start m-2"><strong>ID</strong>  : {{$Comp->id}}</p>
                <p class="text-start m-2"><strong>Email</strong>  : {{$Comp->email}}</p>
                <p class="text-start m-2"><strong>Telephone</strong> : {{$Comp->telephone}}</p>
                <p class="text-start m-2"><strong>Address</strong> : {{$Comp->address}}</p>
                <hr class="m-0">
                @if($Comp->status == 'unblocked')
                    <div type="button" class="btn btn-warning float-end mt-1" >
                        <a href="/admin-profile/block-company/{{$Comp->id}}" class="text-decoration-none text-white fw-bold">Block company</a>
                    </div>
                @endif
                @if($Comp->status == 'blocked')
                    <div type="button" class="btn btn-success float-end mt-1" >
                        <a href="/admin-profile/unblock-company/{{$Comp->id}}" class="text-decoration-none text-white fw-bold">Unblock company</a>
                    </div>
                @endif

            </div>
        @endforeach
@endsection

@extends('admin.adminProfile')

@section('main content')

    @if(count($pendingComps)==0)
        <img src="{{asset('photos/noreq.png')}}" class="mx-auto mt-5 " width="225px" height="200px">
    @endif
    @foreach($pendingComps as $pendingComp)
        <div id="{{$pendingComp->id}}" class="bg-body shadow-on-hover p-2 w-95 mb-1 mx-auto border rounded-3 ">
            <h5 class="text-start">Company Name : {{$pendingComp->compName}}</h5>
            <hr class="m-0">
            <p class="text-start m-2"><strong>ID</strong>  : {{$pendingComp->id}}</p>
            <p class="text-start m-2"><strong>Email</strong>  : {{$pendingComp->email}}</p>
            <p class="text-start m-2"><strong>Telephone</strong> : {{$pendingComp->telephone}}</p>
            <p class="text-start m-2"><strong>Address</strong> : {{$pendingComp->address}}</p>
            <hr class="m-0">
            <button type="button" class="btn btn-primary float-end mt-1"  onclick="activateCompAccount({{$pendingComp->id}})">Activate Account</button>

        </div>
    @endforeach

@endsection

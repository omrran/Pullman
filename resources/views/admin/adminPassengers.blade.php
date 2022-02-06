@extends('admin.adminProfile')

@section('main content')
    <table class="table table-success table-striped table-bordered">
        <tr>
            <th >id</th>
            <th >passenger</th>
            <th>phone</th>
            <th>IDN</th>
            <th>status</th>
            <th></th>
        </tr>
        @foreach($passengers as $passenger)
        <tr id="row{{$passenger->id}}">
            <td id="id{{$passenger->id}}">{{$passenger->id}}</td>
            <td onclick="toggleImgSize('img{{$passenger->id}}')" class="mouse-custom-hover d-flex justify-content-start" title="Click to make image bigger">
                <img id="img{{$passenger->id}}" class="float-start rounded-circle animation-custom-img" src="{{asset('photos/'.$passenger->imagePath)}}" style="width: 50px;height: 50px"  alt="">
                <p id="name{{$passenger->id}}" class="float-start px-2">{{$passenger->fName}} {{$passenger->lName}}</p>
            </td>
            <td id="phone{{$passenger->id}}">{{$passenger->phone}}</td>
            <td id="idn{{$passenger->id}}">{{$passenger->idn}}</td>
            <td id="status{{$passenger->id}}">{{$passenger->status}}</td>
            <td>
                @if($passenger->status == 'unblocked')
                    <button id="block{{$passenger->id}}" type="button" class="btn btn-danger  mt-1"  onclick="blockPassenger({{$passenger->id}},'row{{$passenger->id}}')">Block</button>

                @elseif($passenger->status == 'blocked')
                        <button id="unblock{{$passenger->id}}" type="button" class="btn btn-success  mt-1"  onclick="unBlockPassenger({{$passenger->id}},'row{{$passenger->id}}')">Unblock</button>
                @endif
            </td>
        </tr>
        @endforeach
    </table>
@endsection

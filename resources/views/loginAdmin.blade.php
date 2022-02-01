@extends('A_master')

@section('title')
    <title>login Admin</title>
@endsection



@section('content')

    <div class="container d-flex flex-column justify-content-center bd-highlight ">
        <div id="titleForm" class="m-auto p-3  border rounded-bottom rounded-circle bg-blue text-light">
            Admin
        </div>
        <form class="bg-white w-50 border border-primary border-3 rounded-3 p-2 m-auto" action="{{url('/admin-page')}}"
              method="POST">
            @csrf
            <div class="mb-3 ">
                <label class="form-label">Password :</label>
                @if(Session::has('PasswordFailed'))
                    <small class="text-danger">{{Session::get('PasswordFailed')}}</small>
                @endif
                <input type="password" class="form-control" name="password" aria-describedby="emailHelp">
            </div>

            <button type="submit" class="btn btn-primary w-25 ">log in</button>
        </form>

    </div>

@endsection

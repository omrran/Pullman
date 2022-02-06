@extends('admin.adminProfile')

@section('main content')


    <table class="table table-success table-striped table-bordered w-95 mx-auto">
        <tr>

            <th>Event</th>
            <th>Time</th>
        </tr>
        @foreach($allLogs as $log)
            <tr class="make-border-big-hover">

                <td><strong class="mouse-custom-hover"
                            @if(str_contains($log->actorType, 'company'))
                            onclick="window.location='{{ url("/admin-profile/company/".$log->actorId) }}'"

                            @elseif(str_contains($log->actorType, 'passenger'))
                            onclick="window.location='{{ url("/admin-profile/passenger/".$log->actorId) }}'"
                        @endif
                    >{{$log->actorType}}
                    </strong>
                    add new
                    <strong class="mouse-custom-hover"
                            @if($log->objectType =='trip')
                            onclick="window.location='{{ url("/admin-profile/trip/".$log->objectId) }}'"

                            @elseif($log->objectType =='post' && str_contains($log->actorType, 'company'))
                            onclick="window.location='{{ url("/admin-profile/company/post/".$log->objectId) }}'"

                            @elseif($log->objectType =='post' && str_contains($log->actorType, 'passenger'))
                            onclick="window.location='{{ url("/admin-profile/passenger/post/".$log->objectId) }}'"



                            @elseif($log->objectType =='reserve')
                            onclick="window.location='{{ url("/admin-profile/reserve/".$log->objectId) }}'"

                        @endif

                    >{{$log->objectType}}</strong>
                </td>
                <td>
                    {{$log->created_at}}
                </td>
            </tr>
        @endforeach
    </table>

@endsection

@extends('passenger.passengerProfile')

@section('main content')
    <table class="table table-success table-striped table-bordered w-95 mx-auto">
        <tr>

            <th>Event</th>
            <th>Time</th>
        </tr>
        @foreach($myLogs as $log)
            <tr class="make-border-big-hover">
                <td><strong>{{$log->actorType}}</strong>
                    add new
                    <strong class="mouse-custom-hover"
                            @if($log->objectType =='reserve')
                            onclick="window.location='{{ url("/passenger-profile/reserve/".$log->objectId) }}'"

                            @elseif($log->objectType =='post' && str_contains($log->actorType,'passenger'))
                            onclick="window.location='{{ url("/passenger-profile/post/".$log->objectId) }}'"

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

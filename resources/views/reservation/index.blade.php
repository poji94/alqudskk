@extends('layouts.app')

@section('head')
    Reservations
@endsection

@section('content')
    <div class="container" style="padding-top: 75px">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Reservations</div>

                    <div class="panel-body">
                        @if(Auth::user()->role_user_id == 3)
                            My reservations
                        @else
                            List of reservations made
                        @endif
                        <table class="table">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>User</th>
                                <th>Type</th>
                                <th>Status</th>
                                <th>Date Start</th>
                                <th>Date End</th>
                                <th>Created</th>
                                <th>Updated</th>
                                <th colspan="2">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if($reservations)
                                @foreach($reservations as $reservation)
                                    <tr>
                                        <td>{{$reservation->id}}</td>
                                        <td>{{$reservation->reserveUser->name}}</td>
                                        <td>{{$reservation->reserveType->name}}</td>
                                        <td>{{$reservation->reserveStatus->name}}</td>
                                        <td>{{$reservation->reservation_start}}</td>
                                        <td>{{$reservation->reservation_end}}</td>
                                        <td>{{$reservation->created_at->diffForHumans()}}</td>
                                        <td>{{$reservation->updated_at->diffForHumans()}}</td>
                                        <td><button type="button" class="btn btn-primary" onclick="location.href='{{route('reservation.edit', $reservation->id)}}'">View</button></td>
                                        <td>
                                            <div class="form-group">
                                                {!!  Form::open(['method' => 'DELETE', 'action' => ['ReservationController@destroy', $reservation->id]])!!}
                                                {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                                                {!! Form::close() !!}
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                        <button type="button" class="btn btn-primary" onclick="location.href='{{route('reservation.create')}}'">Create</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

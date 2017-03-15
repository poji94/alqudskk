@extends('layouts.master')

<h1>Reservation</h1>

<button type="button" onclick="location.href='{{route('user.index')}}'">User</button>
<button type="button" onclick="location.href='{{route('itinerary.index')}}'">Itinerary</button>
<button type="button" onclick="location.href='{{route('packagetour.index')}}'">Tour package</button>

<table class="table">
    <thead>
    <tr>
        <th>ID</th>
        <th>User</th>
        <th>Type</th>
        <th>Status</th>
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
                <td>{{$reservation->created_at->diffForHumans()}}</td>
                <td>{{$reservation->updated_at->diffForHumans()}}</td>
                <td><button type="button" onclick="location.href='{{route('reservation.edit', $reservation->id)}}'">Edit</button></td>
                <td>
                    {!!  Form::open(['method' => 'DELETE', 'action' => ['ReservationController@destroy', $reservation->id]])!!}
                    {!! Form::submit('Delete', ['class' => 'btn btn-danger col-sm-6']) !!}
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
    @endif
    </tbody>
</table>
<button type="button" onclick="location.href='{{route('reservation.create')}}'">Create</button>
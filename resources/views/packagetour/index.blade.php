@extends('layouts.master')

<h1>Tour Packages</h1>

<button type="button" onclick="location.href='{{route('user.index')}}'">User</button>
<button type="button" onclick="location.href='{{route('itinerary.index')}}'">Itinerary</button>
<button type="button" onclick="location.href='{{route('reservation.index')}}'">Reservation</button>

<table class="table">
    <thead>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Duration</th>
        <th>Price</th>
        <th>Created</th>
        <th>Updated</th>
        <th colspan="2">Action</th>
    </tr>
    </thead>
    <tbody>
    @if($packagetours)
        @foreach($packagetours as $packagetour)
            <tr>
                <td>{{$packagetour->id}}</td>
                <td>{{$packagetour->name}}</td>
                <td>{{$packagetour->duration}}</td>
                <td>{{$packagetour->price}}</td>
                <td>{{$packagetour->created_at->diffForHumans()}}</td>
                <td>{{$packagetour->updated_at->diffForHumans()}}</td>
                <td><button type="button" onclick="location.href='{{route('packagetour.edit', $packagetour->id)}}'">Edit</button></td>
                <td>
                    {!!  Form::open(['method' => 'DELETE', 'action' => ['PackageTourController@destroy', $packagetour->id]])!!}
                    {!! Form::submit('Delete', ['class' => 'btn btn-danger col-sm-6']) !!}
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
    @endif
    </tbody>
</table>
<button type="button" onclick="location.href='{{route('packagetour.create')}}'">Create</button>
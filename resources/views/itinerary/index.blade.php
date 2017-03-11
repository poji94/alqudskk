@extends('layouts.master')

<h1>Users</h1>
<table class="table">
    <thead>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Duration</th>
        <th>Price</th>
        <th>Created</th>
        <th>Updated</th>
        <th colspan="2">Action</th>
    </tr>
    </thead>
    <tbody>
    @if($itineraries)
        @foreach($itineraries as $itinerary)
            <tr>
                <td>{{$itinerary->id}}</td>
                <td>{{$itinerary->name}}</td>
                <td>{{$itinerary->duration}}</td>
                <td>{{$itinerary->price}}</td>
                <td>{{$itinerary->created_at->diffForHumans()}}</td>
                <td>{{$itinerary->updated_at->diffForHumans()}}</td>
                <td><button type="button" onclick="location.href='{{route('itinerary.edit', $itinerary->id)}}'">Edit</button></td>
                <td>
                    {!!  Form::open(['method' => 'DELETE', 'action' => ['ItineraryController@destroy', $itinerary->id]])!!}
                    {!! Form::submit('Delete', ['class' => 'btn btn-danger col-sm-6']) !!}
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
    @endif
    </tbody>
</table>
<button type="button" onclick="location.href='{{route('itinerary.create')}}'">Create</button>
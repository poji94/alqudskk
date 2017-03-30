@extends('layouts.app')

@section('head')
    Itineraries
@endsection

@section('content')
    <div class="container" style="padding-top: 75px">
        <div class="row">
            <div class="col-sm-6 col-md-offset-3">
                <div class="panel panel-default">
                    <div class="panel-heading">Itineraries</div>

                    <div class="panel-body">
                        List of itineraries available
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Created</th>
                                    <th>Updated</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if($itineraries)
                                    @foreach($itineraries as $itinerary)
                                        <tr>
                                            <td>{{$itinerary->id}}</td>
                                            <td>{{$itinerary->name}}</td>
                                            <td>{{$itinerary->created_at->diffForHumans()}}</td>
                                            <td>{{$itinerary->updated_at->diffForHumans()}}</td>
                                            <td><button type="button" class="btn btn-primary" onclick="location.href='{{route('itinerary.edit', $itinerary->id)}}'">View</button></td>
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                        </div>
                        <button type="button" class="btn btn-primary" onclick="location.href='{{route('itinerary.create')}}'">Create</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

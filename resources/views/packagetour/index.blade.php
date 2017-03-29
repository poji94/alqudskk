@extends('layouts.app')

@section('head')
    Tour Packages
@endsection

@section('content')
    <div class="container" style="padding-top: 5%">
        <div class="row">
            <div class="col-sm-6 col-md-offset-3">
                <div class="panel panel-default">
                    <div class="panel-heading">Tour packages</div>

                    <div class="panel-body">
                        List of itineraries available
                        <div class="responsive-table">
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
                                @if($packagetours)
                                    @foreach($packagetours as $packagetour)
                                        <tr>
                                            <td>{{$packagetour->id}}</td>
                                            <td>{{$packagetour->name}}</td>
                                            <td>{{$packagetour->created_at->diffForHumans()}}</td>
                                            <td>{{$packagetour->updated_at->diffForHumans()}}</td>
                                            <td><button type="button" class="btn btn-primary" onclick="location.href='{{route('packagetour.edit', $packagetour->id)}}'">View</button></td>
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                        </div>
                        <button type="button" class="btn btn-primary" onclick="location.href='{{route('packagetour.create')}}'">Create</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@extends('layouts.backbone')

@section('head')
    Activities
@endsection

@section('style')
    body {
    background: url('/preset/backgroundDarken.jpg') no-repeat center center fixed;
    -webkit-background-size: cover;
    -moz-background-size: cover;
    -o-background-size: cover;
    background-size: cover;
    }
@endsection

@section('bodyClass')
    index-page
@endsection

@section('content')
    {{--<div class="section-full-page">--}}
    <div class="section" id="backgroundUser" data-parallax="true" style="background-image:url('/preset/backgroundDarken.jpg'); background-size: 100% 100%; background-repeat: no-repeat; height: 100vh;">
        <div class="container" style="margin-top: 30px;">
            <div class="row">
                <div class="col-md-10 offset-md-1 ">
                    <div class="card ">
                        <br>
                        <h3 class="category" style="color: black; text-align: center;">Activities Management</h3>
                        <p class="category" style="color: black; text-align: center;">List of stored activities.</p>
                        <br>
                        <div class="card-block">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead style="background-color: #9c27b0; color:white;">
                                    <tr>
                                        <th >ID</th>
                                        <th width="35%">Name</th>
                                        <th >Created</th>
                                        <th >Updated</th>
                                        <th colspan="2">Action</th>
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
                                                <td><button type="button" class="btn btn-primary btn-round " onclick="location.href='{{route('itinerary.edit', $itinerary->id)}}'">View</button></td>
                                                <td><button type="button" class="btn btn-danger btn-round" data-toggle="modal" data-target="#{{$itinerary->id}}">Delete</button></td>
                                                <div class="modal fade" id="{{$itinerary->id}}" role="dialog">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header justify-content-center">
                                                                <h4 class="modal-title">Delete activity confirmation</h4>
                                                            </div>
                                                            <div class="modal-body text-center">
                                                                Activity {{$itinerary->name}} will be deleted. Continue?
                                                            </div>
                                                            <div class="modal-footer justify-content-center">
                                                                {!! Form::open(['method' => 'DELETE', 'action' => ['ItineraryController@destroy', $itinerary->id]])!!}
                                                                {!! Form::submit('Delete', ['class' => ' btn btn-danger btn-round']) !!}
                                                                <button type="button" class="btn btn-primary btn-round" data-dismiss="modal">Cancel</button>
                                                                {!! Form::close() !!}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </tr>
                                        @endforeach
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                            <button type="button" class="btn btn-primary btn-round" onclick="location.href='{{route('itinerary.create')}}'">Create</button>
                        </div>
                        <div class="tab-content text-center">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>


    @if(Session::has('created_itinerary'))
        <script type="text/javascript">
            $(window).on('load',function(){
                $('#created_itinerary').modal('show');
            });
        </script>
        <div class="modal fade" id="created_itinerary" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header justify-content-center">
                        <h4 class="modal-title">Activity created</h4>
                    </div>
                    <div class="modal-body text-center">
                        {{session('created_itinerary')}}
                    </div>
                    <div class="modal-footer justify-content-center">
                        <button type="button" class="btn btn-primary btn-round" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    @endif
    @if(Session::has('updated_itinerary'))
        <script type="text/javascript">
            $(window).on('load',function(){
                $('#updated_itinerary').modal('show');
            });
        </script>
        <div class="modal fade" id="updated_itinerary" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header justify-content-center">
                        <h4 class="modal-title">Activity updated</h4>
                    </div>
                    <div class="modal-body text-center">
                        {{session('updated_itinerary')}}
                    </div>
                    <div class="modal-footer justify-content-center">
                        <button type="button" class="btn btn-primary btn-round" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    @endif
    @if(Session::has('deleted_itinerary'))
        <script type="text/javascript">
            $(window).on('load',function(){
                $('#deleted_itinerary').modal('show');
            });
        </script>
        <div class="modal fade" id="deleted_itinerary" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header justify-content-center">
                        <h4 class="modal-title">Activity deleted</h4>
                    </div>
                    <div class="modal-body text-center">
                        {{session('deleted_itinerary')}}
                    </div>
                    <div class="modal-footer justify-content-center">
                        <button type="button" class="btn btn-primary btn-round" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection

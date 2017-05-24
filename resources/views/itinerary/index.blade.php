@extends('layouts.app')

@section('head')
    Activities
@endsection

@section('content')
    <div class="container" style="padding-top: 75px">
        <div class="row">
            <div class="col-sm-6 col-md-offset-3">
                <div class="panel panel-default">
                    <div class="panel-heading">Activities</div>

                    <div class="panel-body">
                        {!! Form::label('title_label', 'List of activities available') !!}

                        <br>
                        @if(Session::has('created_itinerary'))
                            <script type="text/javascript">
                                $(window).on('load',function(){
                                    $('#created_itinerary').modal('show');
                                });
                            </script>
                            <div class="modal fade" id="created_itinerary" role="dialog">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Activity created</h4>
                                        </div>
                                        <div class="modal-body">
                                            {{session('created_itinerary')}}
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
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
                                        <div class="modal-header">
                                            <h4 class="modal-title">Activity updated</h4>
                                        </div>
                                        <div class="modal-body">
                                            {{session('updated_itinerary')}}
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
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
                                        <div class="modal-header">
                                            <h4 class="modal-title">Activity deleted</h4>
                                        </div>
                                        <div class="modal-body">
                                            {{session('deleted_itinerary')}}
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>                        @endif
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
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
                                            <td>{{$itinerary->created_at->diffForHumans()}}</td>
                                            <td>{{$itinerary->updated_at->diffForHumans()}}</td>
                                            <td><button type="button" class="btn btn-primary" onclick="location.href='{{route('itinerary.edit', $itinerary->id)}}'">View</button></td>
                                            <td><button type="button" class="btn btn-danger" data-toggle="modal" data-target="#{{$itinerary->id}}">Delete</button></td>
                                            <div class="modal fade" id="{{$itinerary->id}}" role="dialog">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Delete activity confirmation</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            Activity {{$itinerary->name}} will be deleted. Continue?
                                                        </div>
                                                        <div class="modal-footer">
                                                            {!! Form::open(['method' => 'DELETE', 'action' => ['ItineraryController@destroy', $itinerary->id]])!!}
                                                                {!! Form::submit('Delete', ['class' => ' btn btn-danger']) !!}
                                                            {!! Form::close() !!}
                                                            <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
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
                        <button type="button" class="btn btn-primary" onclick="location.href='{{route('itinerary.create')}}'">Create</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@extends('layouts.app')

@section('head')
    Tour Packages
@endsection

@section('content')
    <div class="container" style="padding-top: 75px">
        <div class="row">
            <div class="col-sm-6 col-md-offset-3">
                <div class="panel panel-default">
                    <div class="panel-heading">Tour packages</div>

                    <div class="panel-body">
                        {!! Form::label('title_label', 'List of tour packages available') !!}

                        <br>
                        @if(Session::has('created_packagetour'))
                            <script type="text/javascript">
                                $(window).on('load',function(){
                                    $('#created_packagetour').modal('show');
                                });
                            </script>
                            <div class="modal fade" id="created_packagetour" role="dialog">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Tour package created</h4>
                                        </div>
                                        <div class="modal-body">
                                            {{session('created_packagetour')}}
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if(Session::has('updated_packagetour'))
                            <script type="text/javascript">
                                $(window).on('load',function(){
                                    $('#updated_packagetour').modal('show');
                                });
                            </script>
                            <div class="modal fade" id="updated_packagetour" role="dialog">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Tour package updated</h4>
                                        </div>
                                        <div class="modal-body">
                                            {{session('updated_packagetour')}}
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if(Session::has('deleted_packagetour'))
                            <script type="text/javascript">
                                $(window).on('load',function(){
                                    $('#deleted_packagetour').modal('show');
                                });
                            </script>
                            <div class="modal fade" id="deleted_packagetour" role="dialog">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Tour package deleted</h4>
                                        </div>
                                        <div class="modal-body">
                                            {{session('deleted_packagetour')}}
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <div class="responsive-table">
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
                                @if($packagetours)
                                    @foreach($packagetours as $packagetour)
                                        <tr>
                                            <td>{{$packagetour->id}}</td>
                                            <td>{{$packagetour->name}}</td>
                                            <td>{{$packagetour->created_at->diffForHumans()}}</td>
                                            <td>{{$packagetour->updated_at->diffForHumans()}}</td>
                                            <td><button type="button" class="btn btn-primary" onclick="location.href='{{route('packagetour.edit', $packagetour->id)}}'">View</button></td>
                                            <td><button type="button" class="btn btn-danger" data-toggle="modal" data-target="#{{$packagetour->id}}">Delete</button></td>
                                            <div class="modal fade" id="{{$packagetour->id}}" role="dialog">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Delete tour package confirmation</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            Tour package {{$packagetour->name}} will be deleted. Continue?
                                                        </div>
                                                        <div class="modal-footer">
                                                            {!!  Form::open(['method' => 'DELETE', 'action' => ['PackageTourController@destroy', $packagetour->id]])!!}
                                                            {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
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
                        <button type="button" class="btn btn-primary" onclick="location.href='{{route('packagetour.create')}}'">Create</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


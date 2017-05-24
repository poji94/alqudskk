@extends('layouts.app')

@section('head')
    Users
@endsection

@section('content')
    <div class="container" style="padding-top: 75px">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Users</div>

                    <div class="panel-body">
                        {!! Form::label('user_label', 'List of registered users') !!}

                        <br>
                        @if(Session::has('created_user'))
                            <script type="text/javascript">
                                $(window).on('load',function(){
                                    $('#created_user').modal('show');
                                });
                            </script>
                            <div class="modal fade" id="created_user" role="dialog">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">User created</h4>
                                        </div>
                                        <div class="modal-body">
                                            {{session('created_user')}}
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if(Session::has('updated_user'))
                            <script type="text/javascript">
                                $(window).on('load',function(){
                                    $('#updated_user').modal('show');
                                });
                            </script>
                            <div class="modal fade" id="updated_user" role="dialog">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">User updated</h4>
                                        </div>
                                        <div class="modal-body">
                                            {{session('updated_user')}}
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if(Session::has('deleted_user'))
                            <script type="text/javascript">
                                $(window).on('load',function(){
                                    $('#deleted_user').modal('show');
                                });
                            </script>
                            <div class="modal fade" id="deleted_user" role="dialog">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">User deleted</h4>
                                        </div>
                                        <div class="modal-body">
                                            {{session('deleted_user')}}
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
                                    <th>Email</th>
                                    <th>Role User</th>
                                    <th>Phone Number</th>
                                    <th>Created</th>
                                    <th>Updated</th>
                                    <th colspan="2">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if($users)
                                    @foreach($users as $user)
                                        <tr>
                                            <td>{{$user->id}}</td>
                                            <td>{{$user->name}}</td>
                                            <td>{{$user->email}}</td>
                                            <td>{{$user->roleUser->name}}</td>
                                            <td>{{$user->phone_number}}</td>
                                            <td>{{$user->created_at->diffForHumans()}}</td>
                                            <td>{{$user->updated_at->diffForHumans()}}</td>
                                            <td><button type="button" class="btn btn-primary" onclick="location.href='{{route('user.edit', $user->id)}}'">View</button></td>
                                            <td><button type="button" class="btn btn-danger" data-toggle="modal" data-target="#{{$user->id}}">Delete</button></td>
                                            <div class="modal fade" id="{{$user->id}}" role="dialog">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Delete user confirmation</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            User {{$user->name}} will be deleted. Continue?
                                                        </div>
                                                        <div class="modal-footer">
                                                            {!!  Form::open(['method' => 'DELETE', 'action' => ['UserController@destroy', $user->id]])!!}
                                                                {!! Form::submit('Delete', ['class'=>'btn btn-danger']) !!}
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
                        <button type="button" class="btn btn-primary" onclick="location.href='{{route('user.create')}}'">Create</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
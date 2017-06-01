@extends('layouts.backbone')

@section('head')
    Users
@endsection

@section('bodyClass')
    index-page
@endsection

@section('content')
    <div class="section" id="backgroundUser" data-parallax="true" style="background-image:url('/preset/backgroundDarken.jpg'); background-size: cover; background-repeat: no-repeat; height: 100vh;">
        <div class="container" style="margin-top: 30px;">
            <div class="row">
                <div class="col-md-12 offset-md-0 ">
                    <div class="card " style="height: 75vh;">
                        <br>
                        <h3 class="category" style="color: black; text-align: center;">User Management</h3>
                        <p class="category" style="color: black; text-align: center;">List of registered users.</p>
                        <br>
                        <div class="card-block" style="height: 55vh; overflow:scroll;">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead style="background-color: #9c27b0; color:white;">
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
                                                <td><button type="button" class="btn btn-primary btn-round" onclick="location.href='{{route('user.edit', $user->id)}}'">View</button></td>
                                                <td><button type="button" class="btn btn-danger btn-round" data-toggle="modal" data-target="#{{$user->id}}">Delete</button></td>
                                                <div class="modal fade" id="{{$user->id}}" role="dialog">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header justify-content-center">
                                                                <h4 class="modal-title">Delete user confirmation</h4>
                                                            </div>
                                                            <div class="modal-body text-center">
                                                                User {{$user->name}} will be deleted. Continue?
                                                            </div>
                                                            <div class="modal-footer justify-content-center">
                                                                {!!  Form::open(['method' => 'DELETE', 'action' => ['UserController@destroy', $user->id]])!!}
                                                                {!! Form::submit('Delete', ['class'=>'btn btn-danger btn-round']) !!}
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
                            <button type="button" class="btn btn-primary btn-round" onclick="location.href='{{route('user.create')}}'">Create</button>
                        </div>
                            <div class="tab-content text-center">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    @if(Session::has('created_user'))
        <script type="text/javascript">
            $(window).on('load',function(){
                $('#created_user').modal('show');
            });
        </script>
        <div class="modal fade" id="created_user" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header justify-content-center">
                        <h4 class="modal-title">User created</h4>
                    </div>
                    <div class="modal-body text-center">
                        {{session('created_user')}}
                    </div>
                    <div class="modal-footer justify-content-center">
                        <button type="button" class="btn btn-primary btn-round" data-dismiss="modal">Close</button>
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
                    <div class="modal-header justify-content-center">
                        <h4 class="modal-title">User updated</h4>
                    </div>
                    <div class="modal-body text-center">
                        {{session('updated_user')}}
                    </div>
                    <div class="modal-footer justify-content-center">
                        <button type="button" class="btn btn-primary btn-round" data-dismiss="modal">Close</button>
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
                    <div class="modal-header justify-content-center">
                        <h4 class="modal-title">User deleted</h4>
                    </div>
                    <div class="modal-body text-center">
                        {{session('deleted_user')}}
                    </div>
                    <div class="modal-footer justify-content-center">
                        <button type="button" class="btn btn-primary btn-round" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection
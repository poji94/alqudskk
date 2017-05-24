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
                            <p class="bg-info" align="center">{{session('created_user')}}</p>
                        @endif
                        @if(Session::has('updated_user'))
                            <p class="bg-info" align="center">{{session('updated_user')}}</p>
                        @endif
                        @if(Session::has('deleted_user'))
                            <p class="bg-info" align="center">{{session('deleted_user')}}</p>
                        @endif
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
                                            <td>
                                                <div class="form-group">
                                                    {!!  Form::open(['method' => 'DELETE', 'action' => ['UserController@destroy', $user->id]])!!}
                                                    {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                                                    {!! Form::close() !!}
                                                </div>
                                            </td>
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
@extends('layouts.backbone')

@section('head')
    View User
@endsection

@section('bodyClass')
    login-page
@endsection

@section('titlePage')
    <div class="wrapper">
        <div class="page-header">
            <div class="page-header-image" data-parallax="true" style="background-image: url('/preset/background.jpg');"></div>
            <div class="container">
                <div class="col-md-4 content-center" style="margin-top: 25px;">
                    <div class="card card-login card-plain">
                        <form class="form" method="POST" action="{{ url('user/'. $user->id) }}">
                            <input name="_method" type="hidden" value="PATCH">
                            {{ csrf_field() }}
                            <div class="header header-primary text-center">
                                {{--<div class="logo-container">--}}
                                {{--<img src="../assets/img/now-logo.png" alt="">--}}
                                {{--</div>--}}
                                <h3>Edit {{$user->name}}'s information. </h3>
                            </div>
                            <div class="content">
                                <div class="input-group form-group-no-border input-lg{{ $errors->has('name') ? ' has-error' : '' }}">
                                    <input id="name" name="name" type="text" class="form-control" placeholder="Name" value="{{$user->name}}">
                                    @if ($errors->has('name'))
                                        <span class="form-control form-control-danger">
                                {{ $errors->first('name') }}
                            </span>
                                    @endif
                                </div>
                                <div class="input-group form-group-no-border input-lg{{ $errors->has('email') ? ' has-error' : '' }}">
                                    <input id="email" name="email" type="text" class="form-control" placeholder="E-Mail" value="{{$user->email}}">
                                    @if ($errors->has('email'))
                                        <span class="form-control form-control-danger">
                                {{ $errors->first('email') }}
                            </span>
                                    @endif
                                </div>
                                <div class="input-group form-group-no-border input-lg{{ $errors->has('password') ? ' has-error' : '' }}">
                                    <input id="password" name="password" type="password" class="form-control" placeholder="Password">
                                    @if ($errors->has('password'))
                                        <span class="form-control form-control-danger">
                                {{ $errors->first('password') }}
                            </span>
                                    @endif
                                </div>
                                <div class="input-group form-group-no-border input-lg{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                    <input id="password_confirmation" name="password_confirmation" type="password" class="form-control" placeholder="Confirm  Password">
                                    @if ($errors->has('password_confirmation'))
                                        <span class="form-control form-control-danger">
                                {{ $errors->first('password_confirmation') }}
                            </span>
                                    @endif
                                </div>
                                <div class="input-group form-group-no-border input-lg{{ $errors->has('role_user_id') ? ' has-error' : '' }}">
                                    {!! Form::select('role_user_id', [''=>'Choose User Role'] + $roleUser, $user->role_user_id, ['class'=>'form-control']) !!}
                                    <style>
                                        option {
                                            color: black;
                                        }
                                    </style>
                                    @if ($errors->has('user_role_id'))
                                        <span class="form-control form-control-danger">
                                {{ $errors->first('role_user_id') }}
                            </span>
                                    @endif
                                </div>
                                <div class="input-group form-group-no-border input-lg{{ $errors->has('phone_number') ? ' has-error' : '' }}">
                                    <input id="phone-number" name="phone_number" type="text" class="form-control" onkeypress="return isNumber(event)" placeholder="Phone Number" value="{{ $user->phone_number }}">
                                    <script type="text/javascript">
                                        function isNumber(evt) {
                                            evt = (evt) ? evt : window.event;
                                            var charCode = (evt.which) ? evt.which : evt.keyCode;
                                            if ( (charCode > 31 && charCode < 48) || charCode > 57) {
                                                return false;
                                            }
                                            return true;
                                        }
                                    </script>
                                    @if ($errors->has('phone_number'))
                                        <span class="form-control form-control-danger">
                                {{ $errors->first('phone_number') }}
                            </span>
                                    @endif
                                </div>
                            </div>
                            <div class="footer text-center">
                                <button type="submit" class="btn btn-primary btn-round btn-lg btn-block">Edit User</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{--<div class="container" style="padding-top: 75px">--}}
        {{--<div class="row">--}}
            {{--<div class="col-sm-6 col-md-offset-3">--}}
                {{--<div class="panel panel-default">--}}
                    {{--<div class="panel-heading">View User</div>--}}

                    {{--<div class="panel-body">--}}
                        {!! Form::model($user, ['method'=>'PATCH', 'action'=> ['UserController@update', $user->id], 'files' => true]) !!}
                        {{--<div class="form-group">--}}
                            {{--<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">--}}
                                {{--{!! Form::label('name', 'Name') !!}--}}
                                {{--{!! Form::text('name', null, ['class'=>'form-control']) !!}--}}
                                {{--@if ($errors->has('name'))--}}
                                    {{--<span class="help-block">--}}
                                        {{--<strong>{{ $errors->first('name') }}</strong>--}}
                                    {{--</span>--}}
                                {{--@endif--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="form-group">--}}
                            {{--<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">--}}
                                {{--{!! Form::label('email', 'Email') !!}--}}
                                {{--{!! Form::email('email', null, ['class'=>'form-control', 'readonly']) !!}--}}
                                {{--@if ($errors->has('email'))--}}
                                    {{--<span class="help-block">--}}
                                        {{--<strong>{{ $errors->first('email') }}</strong>--}}
                                    {{--</span>--}}
                                {{--@endif--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="form-group">--}}
                            {{--<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">--}}
                                {{--{!! Form::label('password', 'Password') !!}--}}
                                {{--{!! Form::password('password', ['class'=>'form-control']) !!}--}}
                                {{--@if ($errors->has('password'))--}}
                                    {{--<span class="help-block">--}}
                                        {{--<strong>{{ $errors->first('password') }}</strong>--}}
                                    {{--</span>--}}
                                {{--@endif--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="form-group">--}}
                            {{--<div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">--}}
                                {{--{!! Form::label('password_confirmation', 'Confirm Password') !!}--}}
                                {{--{!! Form::password('password_confirmation', ['class'=>'form-control']) !!}--}}
                                {{--@if ($errors->has('password_confirmation'))--}}
                                    {{--<span class="help-block">--}}
                                        {{--<strong>{{ $errors->first('password_confirmation') }}</strong>--}}
                                    {{--</span>--}}
                                {{--@endif--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="form-group">--}}
                            {{--<div class="form-group{{ $errors->has('role_user_id') ? ' has-error' : '' }}">--}}
                                {{--{!! Form::label('role_user_id', 'Role User') !!}--}}
                                {{--{!! Form::select('role_user_id', [''=>'Choose Options'] + $roleUser, null, ['class'=>'form-control']) !!}--}}
                                {{--@if ($errors->has('role_user_id'))--}}
                                    {{--<span class="help-block">--}}
                                        {{--<strong>{{ $errors->first('role_user_id') }}</strong>--}}
                                    {{--</span>--}}
                                {{--@endif--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="form-group">--}}
                            {{--<div class="form-group{{ $errors->has('phone_number') ? ' has-error' : '' }}">--}}
                                {{--{!! Form::label('phone_number', 'Phone Number') !!}--}}
                                {{--{!! Form::text('phone_number', null, ['class'=>'form-control', 'onkeypress'=>"return isNumber(event)"]) !!}--}}
                                {{--<script type="text/javascript">--}}
                                    {{--function isNumber(evt) {--}}
                                        {{--evt = (evt) ? evt : window.event;--}}
                                        {{--var charCode = (evt.which) ? evt.which : evt.keyCode;--}}
                                        {{--if ( (charCode > 31 && charCode < 48) || charCode > 57) {--}}
                                            {{--return false;--}}
                                        {{--}--}}
                                        {{--return true;--}}
                                    {{--}--}}
                                {{--</script>--}}
                                {{--@if ($errors->has('phone_number'))--}}
                                    {{--<span class="help-block">--}}
                                        {{--<strong>{{ $errors->first('phone_number') }}</strong>--}}
                                    {{--</span>--}}
                                {{--@endif--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="form-group">--}}
                            {{--{!! Form::submit('Edit User', ['class'=>'btn btn-primary']) !!}--}}
                            {{--<button type="button" class="btn btn-primary" onclick="location.href='{{route('user.index')}}'">Cancel</button>--}}
                        {{--</div>--}}
                        {{--{!! Form::close() !!}--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
@endsection

@extends('layouts.app')

@section('head')
    View User
@endsection

@section('content')
    <div class="container" style="padding-top: 75px">
        <div class="row">
            <div class="col-sm-6 col-md-offset-3">
                <div class="panel panel-default">
                    <div class="panel-heading">View User</div>

                    <div class="panel-body">
                        {!! Form::model($user, ['method'=>'PATCH', 'action'=> ['UserController@update', $user->id], 'files' => true]) !!}
                        <div class="form-group">
                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                {!! Form::label('name', 'Name') !!}
                                {!! Form::text('name', null, ['class'=>'form-control']) !!}
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                {!! Form::label('email', 'Email') !!}
                                {!! Form::email('email', null, ['class'=>'form-control', 'readonly']) !!}
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                {!! Form::label('password', 'Password') !!}
                                {!! Form::password('password', ['class'=>'form-control']) !!}
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                {!! Form::label('password_confirmation', 'Confirm Password') !!}
                                {!! Form::password('password_confirmation', ['class'=>'form-control']) !!}
                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-group{{ $errors->has('role_user_id') ? ' has-error' : '' }}">
                                {!! Form::label('role_user_id', 'Role User') !!}
                                {!! Form::select('role_user_id', [''=>'Choose Options'] + $roleUser, null, ['class'=>'form-control']) !!}
                                @if ($errors->has('role_user_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('role_user_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-group{{ $errors->has('phone_number') ? ' has-error' : '' }}">
                                {!! Form::label('phone_number', 'Phone Number') !!}
                                {!! Form::text('phone_number', null, ['class'=>'form-control', 'onkeypress'=>"return isNumber(event)"]) !!}
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
                                    <span class="help-block">
                                        <strong>{{ $errors->first('phone_number') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            {!! Form::submit('Edit User', ['class'=>'btn btn-primary']) !!}
                        </div>
                        {!! Form::close() !!}
                        @if(Auth::user()->user_role_id == 3)
                            <div class="form-group">
                                {!!  Form::open(['method' => 'DELETE', 'action' => ['UserController@destroy', $user->id]])!!}
                                {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                                {!! Form::close() !!}
                            </div>
                        @endif
                        <button type="button" class="btn btn-primary" onclick="location.href='{{route('user.index')}}'">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

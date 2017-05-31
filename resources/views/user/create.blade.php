@extends('layouts.backbone')

@section('head')
    Add User
@endsection

@section('bodyClass')
    login-page
@endsection

@section('form')
    <div class="wrapper">
        <div class="page-header">
            <div class="page-header-image" data-parallax="true" style="background-image: url('/preset/backgroundMoreDarken.jpg');"></div>
            <div class="container">
                <div class="col-md-4 content-center" style="margin-top: 35px;">
                    <div class="card card-login card-plain">
                        <form class="form" method="POST" action="{{url('/user')}}">
                            {{ csrf_field() }}
                            <div class="header header-primary text-center">
                                {{--<div class="logo-container">--}}
                                {{--<img src="../assets/img/now-logo.png" alt="">--}}
                                {{--</div>--}}
                                <h3>Please insert new user information.</h3>
                            </div>
                            <div class="content">
                                <div class="input-group form-group-no-border input-lg{{ $errors->has('name') ? ' has-error' : '' }}">
                                    <input id="name" name="name" type="text" class="form-control" placeholder="Name">
                                </div>
                                @if ($errors->has('name'))
                                    <span class="badge badge-danger">
                                            {{ $errors->first('name') }}
                                        </span>
                                @endif
                                <div class="input-group form-group-no-border input-lg{{ $errors->has('email') ? ' has-error' : '' }}">
                                    <input id="email" name="email" type="text" class="form-control" placeholder="E-Mail">
                                </div>
                                @if ($errors->has('email'))
                                    <span class="badge badge-danger">
                                            {{ $errors->first('email') }}
                                        </span>
                                @endif
                                <div class="input-group form-group-no-border input-lg{{ $errors->has('password') ? ' has-error' : '' }}">
                                    <input id="password" name="password" type="password" class="form-control" placeholder="Password">
                                </div>
                                @if ($errors->has('password'))
                                    <span class="badge badge-danger">
                                            {{ $errors->first('password') }}
                                        </span>
                                @endif
                                <div class="input-group form-group-no-border input-lg{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                    <input id="password_confirmation" name="password_confirmation" type="password" class="form-control" placeholder="Confirm  Password">
                                </div>
                                @if ($errors->has('password_confirmation'))
                                    <span class="badge badge-danger">
                                            {{ $errors->first('password_confirmation') }}
                                        </span>
                                @endif
                                <div class="input-group form-group-no-border input-lg{{ $errors->has('role_user_id') ? ' has-error' : '' }}">
                                    {!! Form::select('role_user_id', [''=>'Choose User Role'] + $roleUser, null, ['class'=>'form-control', 'style'=>'color: white;']) !!}
                                    <style>
                                        option {
                                            color: black;
                                        }
                                    </style>
                                </div>
                                @if ($errors->has('user_role_id'))
                                    <span class="badge badge-danger">
                                            {{ $errors->first('role_user_id') }}
                                        </span>
                                @endif
                                <div class="input-group form-group-no-border input-lg{{ $errors->has('phone_number') ? ' has-error' : '' }}">
                                    <input id="phone-number" name="phone_number" type="text" class="form-control" onkeypress="return isNumber(event)" placeholder="Phone Number">
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
                                </div>
                                @if ($errors->has('phone_number'))
                                    <span class="badge badge-danger">
                                            {{ $errors->first('phone_number') }}
                                        </span>
                                @endif
                            </div>
                            <div class="row footer text-center">
                                <button type="submit" class="col-sm-6 btn btn-primary btn-round btn-lg btn-block">Add User</button>
                                <button type="button" class="col-sm-6 btn btn-warning btn-round" onclick="location.href='{{route('user.index')}}'">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@extends('layouts.backbone')

@section('head')
    Login
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
                        <form class="form" method="POST" action="{{ url('/login') }}">
                            {{ csrf_field() }}
                            <div class="header header-primary text-center">
                                {{--<div class="logo-container">--}}
                                {{--<img src="../assets/img/now-logo.png" alt="">--}}
                                {{--</div>--}}
                                <h3>Hey, haven't seen you in a while,<br>
                                    please log-in.</h3>
                            </div>
                            <div class="content">
                                <div class="input-group form-group-no-border input-lg{{ $errors->has('email') ? ' has-error' : '' }}">
                                    <input id="email" name="email" type="text" class="form-control" placeholder="Your E-Mail">
                                </div>
                                @if ($errors->has('email'))
                                    <span class="badge badge-danger">
                                        {{ $errors->first('email') }}
                                    </span>
                                @endif
                                <div class="input-group form-group-no-border input-lg{{ $errors->has('password') ? ' has-error' : '' }}">
                                    <input id="password" name="password" type="password" class="form-control" placeholder="Your Password">
                                </div>
                                @if ($errors->has('password'))
                                    <span class="badge badge-danger">
                                        {{ $errors->first('password') }}
                                    </span>
                                @endif
                                <div class="checkbox checkbox-primary">
                                    <input id="remember" type="checkbox" name="remember">
                                    <label for="remember">
                                        Remember Me
                                    </label>
                                </div>
                            </div>
                            <div class="footer text-center">
                                <button type="submit" class="btn btn-primary btn-round btn-lg btn-block">Login</button>
                            </div>
                            <div class="pull-center">
                                <h6>
                                    <a href="{{ url('/register') }}" class="link" style="color: white;">But, I don't have an account.</a>
                                </h6>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

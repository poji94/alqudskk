@extends('layouts.backbone')

@section('head')
    Tourist Registration
@endsection

@section('bodyClass')
    login-page
@endsection

@section('form')
    <div class="wrapper">
        <div class="page-header">
            <div class="page-header-image" data-parallax="true" style="background-image: url('/preset/backgroundMoreDarken.jpg');" style="opacity:0.5;"></div>
            <div class="container">
                <div class="col-md-4 content-center" style="margin-top: 35px;">
                    <div class="card card-login card-plain">
                        <form class="form" method="POST" action="{{url('/register')}}">
                            {{ csrf_field() }}
                            <div class="header header-primary text-center">
                                {{--<div class="logo-container">--}}
                                {{--<img src="../assets/img/now-logo.png" alt="">--}}
                                {{--</div>--}}
                                <h3>Are you new here?<br>
                                    Feel free to register.</h3>
                            </div>
                            <div class="content">
                                <div class="input-group form-group-no-border input-lg{{ $errors->has('name') ? ' has-error' : '' }}">
                                    <input id="name" name="name" type="text" class="form-control" placeholder="Your Name">
                                </div>
                                @if ($errors->has('name'))
                                    <span class="badge badge-danger">
                                            {{ $errors->first('name') }}
                                    </span>
                                @endif
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
                                <div class="input-group form-group-no-border input-lg{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                    <input id="password_confirmation" name="password_confirmation" type="password" class="form-control" placeholder="Confirming Your Password">
                                </div>
                                @if ($errors->has('password_confirmation'))
                                    <span class="badge badge-danger">
                                        {{ $errors->first('password_confirmation') }}
                                    </span>
                                @endif
                                <div class="input-group form-group-no-border input-lg{{ $errors->has('phone_number') ? ' has-error' : '' }}">
                                    <input id="phone-number" name="phone_number" type="text" class="form-control" placeholder="Your Phone Number" onkeypress="return isNumber(event)">
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
                            <div class="footer text-center">
                                <button type="submit" class="btn btn-primary btn-round btn-lg btn-block">Register</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

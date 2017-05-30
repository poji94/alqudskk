<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76"  href="/preset/icon.png">
    <link rel="icon" type="image/png"  href="/preset/icon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>@yield('head')</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />
    <!-- CSS Files -->
    <link href="/assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="/assets/css/now-ui-kit.css" rel="stylesheet" />
    <!-- CSS Just for demo purpose, don't include it in your project -->
    {{--<link href="/assets/css/demo.css" rel="stylesheet" />--}}
</head>

<body class="@yield('bodyclass')">
    @include('layouts.navigationBar')

    <div class="wrapper">
        <div class="page-header">
            <div class="page-header-image" data-parallax="true" style="background-image: url('/preset/background.jpg');" style="opacity:0.5;"></div>
            <div class="container">
                @yield('content')
                {{--<h6 class="category category-absolute">Designed by--}}
                {{--<a href="http://invisionapp.com/" target="_blank">--}}
                {{--<img src="./assets/img/invision-white-slim.png" class="invision-logo" />--}}
                {{--</a>. Coded by--}}
                {{--<a href="https://www.creative-tim.com" target="_blank">--}}
                {{--<img src="./assets/img/creative-tim-white-slim2.png" class="creative-tim-logo" />--}}
                {{--</a>.--}}
                {{--</h6>--}}
            </div>
        </div>
    </div>
    <div class="main">

    </div>
</body>
<!--   Core JS Files   -->
<script src="./assets/js/core/jquery.3.2.1.min.js" type="text/javascript"></script>
<script src="./assets/js/core/tether.min.js" type="text/javascript"></script>
<script src="./assets/js/core/bootstrap.min.js" type="text/javascript"></script>
<!--  Plugin for Switches, full documentation here: http://www.jque.re/plugins/version3/bootstrap.switch/ -->
<script src="./assets/js/plugins/bootstrap-switch.js"></script>
<!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
<script src="./assets/js/plugins/nouislider.min.js" type="text/javascript"></script>
<!--  Plugin for the DatePicker, full documentation here: https://github.com/uxsolutions/bootstrap-datepicker -->
<script src="./assets/js/plugins/bootstrap-datepicker.js" type="text/javascript"></script>
<!-- Control Center for Now Ui Kit: parallax effects, scripts for the example pages etc -->
<script src="./assets/js/now-ui-kit.js" type="text/javascript"></script>
{{--<script type="text/javascript">--}}
    {{--$(document).ready(function() {--}}
        {{--// the body of this function is in assets/js/now-ui-kit.js--}}
        {{--nowuiKit.initSliders();--}}
    {{--});--}}
{{--</script>--}}

</html>
@extends('layouts.backbone')

@section('head')
    AlQudsTravel KK
@endsection

{{--@section('styles')--}}
    {{--.carousel-inner > .item > img,--}}
    {{--.carousel-inner > .item > a > img {--}}
        {{--margin: auto;--}}
    {{--}--}}
{{--@endsection--}}

@section('bodyClass')
    index-page
@endsection


@section('titlePage')
    <div class="wrapper">
        <div class="page-header">
            <div class="page-header-image" data-parallax="true" style="background-image: url('/preset/backgroundDarken.jpg');"></div>
            <div class="container">
                <div class="content-center brand">
                    {{--<img class="n-logo" src="./assets/img/now-logo.png" alt="">--}}
                    @if(Auth::guest())
                        <h1 class="h1-seo">Hello There.</h1>
                        <h3>If you want to find something leisuring, <br>
                            You come on the right place.</h3>
                    @else
                        <h1 class="h1-seo">Hey, {{Auth::user()->name}}</h1>
                        <h3>It is nice to see you,<br>
                            we hope you are delighted in here.</h3>
                    @endif
                </div>
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
        <div class="section" style="margin-top: -70px; background-image: url('/preset/backgroundItineraryDarken.png'); background-size: 100% 100%; background-repeat: no-repeat;">
            <h3 class="title text-center" style="color: white;">
                We do provide some activities and plan your vacation by your own <br>
                Click <a href="{{route('itinerary.getSelection')}}" style="color: rgb(206, 147, 216);">here</a> to see more.
            </h3>
            {{--<div class="card" style="background-color: rgb(171, 71, 188); width:100vw;">--}}
            <div class="card" style="background-color: transparent; width:100vw;">
                <div class="row" style=" overflow: auto;">
                    @if($itineraries)
                        @foreach($itineraries as $itinerary)
                                @php
                                    $i = 0;
                                @endphp
                                @foreach($itinerary->medias as $media)
                                    @if($i == 0)
                                    <div class="col-sm-3" style="margin-top: 15px;">
                                        <a href="{{route('itinerary.show', $itinerary->id)}}">
                                            <img src="{{$media->path}}" class="img-responsive img-rounded img-raised" alt="" style="width: 100vw; height: 35vh;">
                                            <p class="category text-center" style="color: white;">{{$itinerary->name}}</p>
                                        </a>
                                    </div>
                                    @endif
                                    @php
                                        $i++;
                                    @endphp
                                @endforeach
                        @endforeach
                    @endif

                </div>
            </div>
        </div>
        <div class="section" style="margin-top: -70px; background-image: url('/preset/backgroundPackageTourDarken.jpg'); background-size: 100% 100%; background-repeat: no-repeat;">
            <h3 class="title text-center" style="color: white;">
                You want easy and fast? <br>
                We got that for you. More on <a href="{{route('packagetour.getSelection')}}" style="color: rgb(206, 147, 216);">here</a>
            </h3>
            {{--<div class="card" style="background-color: rgb(171, 71, 188); width:100vw;">--}}
            <div class="card" style="background-color: transparent; width:100vw;">
                <div class="row"  style=" overflow: auto;">
                    @if($packageTours)
                        @foreach($packageTours as $packageTour)
                                @php
                                    $i = 0;
                                @endphp
                                @foreach($packageTour->medias as $media)
                                    @if($i == 0)
                                        <div class="col-sm-3" style="margin-top: 15px;">
                                            <a href="{{route('packagetour.show', $packageTour->id)}}">
                                                <img src="{{$media->path}}" class="img-responsive img-rounded img-raised" alt="" style="width: 100vw; height: 35vh;">
                                                <p class="category text-center" style="color: white;">{{$packageTour->name}}</p>
                                            </a>
                                        </div>
                                    @endif
                                    @php
                                        $i++;
                                    @endphp
                                @endforeach
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

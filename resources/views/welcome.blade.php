@extends('layouts.app')

@section('head')
    AlQudsTravel KK
@endsection

@section('styles')
    .carousel-inner > .item > img,
    .carousel-inner > .item > a > img {
        margin: auto;
    }
@endsection

@section('content')
<div class="container" style="padding-top: 75px">
    <div class="row">
        <div class="col-sm-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">List of itineraries</div>
                <div class="panel-body">We provide itineraries to choose for you
                    @if($itineraries)
                        @foreach($itineraries as $itinerary)
                            <div class="row page-header">
                                @php
                                    $i = 0;
                                @endphp
                                @foreach($itinerary->medias as $media)
                                    @if($i == 0)
                                        <div class="col-sm-4">
                                            <img src="{{$media->path}}" alt="" class="img-responsive img-rounded" style="height: 150px; width: 230px;">
                                        </div>
                                    @endif
                                    @php
                                        $i++;
                                    @endphp
                                @endforeach
                                <div class="col-sm-6">
                                    Name: {{ $itinerary->name }} <br>
                                    Duration: {{ $itinerary->duration }} <br>
                                    Price per Adult: RM {{ $itinerary->price_adult }} <br>
                                    Price per Child: RM {{ $itinerary->price_children }} <br>
                                    <button type="button" class="btn btn-primary" onclick="location.href='{{route('itinerary.show', $itinerary->id)}}'">View</button>
                                    @if(Auth::guest())
                                        <button type="button" class="btn btn-primary" onclick="location.href='{{url('/login')}}'">Book Now</button>
                                    @else
                                        <button type="button" class="btn btn-primary" onclick="location.href='{{url('/reservation/create')}}'">Book Now</button>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
    <div class="container">
        <div class="row">
            <div class="col-sm-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">List of tour packages</div>
                    <div class="panel-body">We do also supply collection of activities with reasonable prices
                        @if($packageTours)
                            @foreach($packageTours as $packageTour)
                                <div class="row page-header">
                                    @php
                                        $i = 0;
                                    @endphp
                                    @foreach($packageTour->itineraries as $itinerary)
                                        @foreach($itinerary->medias as $media)
                                            @if($i == 0)
                                                <div class="col-sm-4">
                                                    <img src="{{$media->path}}" class="img-responsive img-rounded" alt="" style="height: 150px; width: 230px;">
                                                </div>
                                            @endif
                                            @php
                                                $i++;
                                            @endphp
                                        @endforeach
                                    @endforeach
                                    <div class="col-sm-6">
                                        Name: {{ $packageTour->name }} <br>
                                        Duration: {{ $packageTour->duration }} <br>
                                        Price per Adult: RM {{ $packageTour->price_adult }} <br>
                                        Price per Child: RM {{ $packageTour->price_children }} <br>
                                        <button type="button" class="btn btn-primary" onclick="location.href='{{route('packagetour.show', $packageTour->id)}}'">View</button>
                                        @if(Auth::guest())
                                            <button type="button" class="btn btn-primary" onclick="location.href='{{url('/login')}}'">Book Now</button>
                                        @else
                                            <button type="button" class="btn btn-primary" onclick="location.href='{{url('/reservation/create')}}'">Book Now</button>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@extends('layouts.app')

@section('head')
    View Vacation
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
            <div class="col-sm-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">View Vacation</div>

                    <div class="panel-body">
                        Vacation details
                        <div class="row">
                            <div class="col-sm-5">
                                <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                    <!-- Indicators -->
                                    <ol class="carousel-indicators">
                                        @php
                                            $i = 0;
                                        @endphp
                                        @foreach($itinerary->medias as $media)
                                            @if($i == 0)
                                                <li data-target="#myCarousel" data-slide-to="{{$i}}" class="active"></li>
                                            @else
                                                <li data-target="#myCarousel" data-slide-to="{{$i}}"></li>
                                            @endif
                                            @php
                                                $i++;
                                            @endphp
                                        @endforeach
                                    </ol>

                                    <!-- Wrapper for slides -->
                                    <div class="carousel-inner" role="listbox">
                                        @php
                                            $i = 0;
                                        @endphp
                                        @foreach($itinerary->medias as $media)
                                            @if($i == 0)
                                                <div class="item active">
                                                    <img src="{{ $media->path }}" alt="" width="460" height="345">
                                                </div>
                                            @else
                                                <div class="item">
                                                    <img src="{{ $media->path }}" alt="" width="460" height="345">
                                                </div>
                                            @endif
                                            @php
                                                $i++;
                                            @endphp
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                Name: {{ $itinerary ->name }} <br><br>
                                Description: {{$itinerary->description}} <br><br>
                                Duration: {{ $itinerary->duration }} <br><br>
                                Price per adult: {{ $itinerary->price_adult }} <br><br>
                                Price per children: {{ $itinerary->price_children }} <br><br>
                                <button type="button" class="btn btn-primary" onclick="location.href='{{url('/login')}}'">Book Now</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-sm-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Suggestion for places nearby</div>
                    <div class="panel-body">
                        @if($selectedPlaceItineraries)
                            @foreach($selectedPlaceItineraries as $selectedPlaceItinerary)
                                <div class="row page-header">
                                    @php
                                        $i = 0;
                                    @endphp
                                    @foreach($selectedPlaceItinerary->medias as $media)
                                        @if($i == 0)
                                            <div class="col-sm-4">
                                                <img src="{{$media->path}}" alt="" style="height: 150px; width: 230px;">
                                            </div>
                                        @endif
                                        @php
                                            $i++;
                                        @endphp
                                    @endforeach
                                    <div class="col-sm-6">
                                        Name: {{ $selectedPlaceItinerary->name }} <br>
                                        Duration: {{ $selectedPlaceItinerary->duration }} <br>
                                        Price per Adult: {{ $selectedPlaceItinerary->price_adult }} <br>
                                        Price per Child: {{ $selectedPlaceItinerary->price_children }} <br>
                                        <button type="button" class="btn btn-primary" onclick="location.href='{{route('itinerary.show', $selectedPlaceItinerary->id)}}'">View</button>
                                        <button type="button" class="btn btn-primary" onclick="location.href='{{url('/login')}}'">Book Now</button>
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
                    <div class="panel-heading">Suggestion for places nearby</div>
                    <div class="panel-body">
                        @if($selectedTypeItineraries)
                            @foreach($selectedTypeItineraries as $selectedTypeItinerary)
                                <div class="row page-header">
                                    @php
                                        $i = 0;
                                    @endphp
                                    @foreach($selectedTypeItinerary->medias as $media)
                                        @if($i == 0)
                                            <div class="col-sm-4">
                                                <img src="{{$media->path}}" alt="" style="height: 150px; width: 230px;">
                                            </div>
                                        @endif
                                        @php
                                            $i++;
                                        @endphp
                                    @endforeach
                                    <div class="col-sm-6">
                                        Name: {{ $selectedTypeItinerary->name }} <br>
                                        Duration: {{ $selectedTypeItinerary->duration }} <br>
                                        Price per Adult: {{ $selectedTypeItinerary->price_adult }} <br>
                                        Price per Child: {{ $selectedTypeItinerary->price_children }} <br>
                                        <button type="button" class="btn btn-primary" onclick="location.href='{{route('itinerary.show', $selectedTypeItinerary->id)}}'">View</button>
                                        <button type="button" class="btn btn-primary" onclick="location.href='{{url('/login')}}'">Book Now</button>
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
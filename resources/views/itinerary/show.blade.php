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
                                                    <img src="{{ $media->path }}" class="img-responsive img-rounded" alt="" width="460" height="345">
                                                </div>
                                            @else
                                                <div class="item">
                                                    <img src="{{ $media->path }}" class="img-responsive img-rounded" alt="" width="460" height="345">
                                                </div>
                                            @endif
                                            @php
                                                $i++;
                                            @endphp
                                        @endforeach
                                    </div>
                                    <!-- Left and right controls -->
                                    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                                        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                                        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                Name: {{ $itinerary ->name }} <br><br>
                                Description: {{$itinerary->description}} <br><br>
                                Duration: {{ $itinerary->duration }} <br><br>
                                Price per adult: RM {{ $itinerary->price_adult }} <br><br>
                                Price per children: RM {{ $itinerary->price_children }} <br><br>
                                @if(Auth::guest())
                                    <button type="button" class="btn btn-primary" onclick="location.href='{{url('/login')}}'">Book Now</button>
                                @else
                                    <button type="button" class="btn btn-primary" onclick="location.href='{{url('/reservation/create')}}'">Book Now</button>
                                @endif
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
                    <div class="panel-heading">Suggestion for places nearby {{$itinerary->places->first()->name}}</div>
                    <div class="panel-body">
                        @if($selectedPlaceItineraries)
                            @foreach($selectedPlaceItineraries as $selectedPlaceItinerary)
                                @if($selectedPlaceItinerary->id == $itinerary->id)

                                @else
                                    <div class="row page-header">
                                        @php
                                            $i = 0;
                                        @endphp
                                        @foreach($selectedPlaceItinerary->medias as $media)
                                            @if($i == 0)
                                                <div class="col-sm-4">
                                                    <img src="{{$media->path}}" class="img-responsive img-rounded" alt="" style="height: 150px; width: 230px;">
                                                </div>
                                            @endif
                                            @php
                                                $i++;
                                            @endphp
                                        @endforeach
                                        <div class="col-sm-6">
                                            Name: {{ $selectedPlaceItinerary->name }} <br>
                                            Duration: {{ $selectedPlaceItinerary->duration }} <br>
                                            Price per Adult: RM {{ $selectedPlaceItinerary->price_adult }} <br>
                                            Price per Child: RM {{ $selectedPlaceItinerary->price_children }} <br>
                                            <button type="button" class="btn btn-primary" onclick="location.href='{{route('itinerary.show', $selectedPlaceItinerary->id)}}'">View</button>
                                            @if(Auth::guest())
                                                <button type="button" class="btn btn-primary" onclick="location.href='{{url('/login')}}'">Book Now</button>
                                            @else
                                                <button type="button" class="btn btn-primary" onclick="location.href='{{url('/reservation/create')}}'">Book Now</button>
                                            @endif
                                        </div>
                                    </div>
                                @endif
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
                    <div class="panel-heading">Suggestion for similar type: {{$itinerary->types->first()->name}}</div>
                    <div class="panel-body">
                        @if($selectedTypeItineraries)
                            @foreach($selectedTypeItineraries as $selectedTypeItinerary)
                                @if($selectedTypeItinerary->id == $itinerary->id)

                                @else
                                    <div class="row page-header">
                                        @php
                                            $i = 0;
                                        @endphp
                                        @foreach($selectedTypeItinerary->medias as $media)
                                            @if($i == 0)
                                                <div class="col-sm-4">
                                                    <img src="{{$media->path}}" class="img-responsive img-rounded" alt="" style="height: 150px; width: 230px;">
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
                                            @if(Auth::guest())
                                                <button type="button" class="btn btn-primary" onclick="location.href='{{url('/login')}}'">Book Now</button>
                                            @else
                                                <button type="button" class="btn btn-primary" onclick="location.href='{{url('/reservation/create')}}'">Book Now</button>
                                            @endif
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
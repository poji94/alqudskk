@extends('layouts.app')

@section('head')
    View Vacation
@endsection

@section('content')
    <div class="container" style="padding-top: 75px">
        <div class="row">
            <div class="col-sm-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">View Vacation</div>

                    <div class="panel-body">
                        Vacation details
                        <div class="row">
                            <div class="col-sm-5"></div>
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
                                <div class="page-header">
                                    Name: {{ $selectedPlaceItinerary->name }} <br>
                                    Duration: {{ $selectedPlaceItinerary->duration }} <br>
                                    Price per Adult: {{ $selectedPlaceItinerary->price_adult }} <br>
                                    Price per Child: {{ $selectedPlaceItinerary->price_children }} <br>
                                    <button type="button" class="btn btn-primary" onclick="location.href='{{route('itinerary.show', $selectedPlaceItinerary->id)}}'">View</button>
                                    <button type="button" class="btn btn-primary" onclick="location.href='{{url('/login')}}'">Book Now</button>
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
                                <div class="page-header">
                                    Name: {{ $selectedTypeItinerary->name }} <br>
                                    Duration: {{ $selectedTypeItinerary->duration }} <br>
                                    Price per Adult: {{ $selectedTypeItinerary->price_adult }} <br>
                                    Price per Child: {{ $selectedTypeItinerary->price_children }} <br>
                                    <button type="button" class="btn btn-primary" onclick="location.href='{{route('itinerary.show', $selectedTypeItinerary->id)}}'">View</button>
                                    <button type="button" class="btn btn-primary" onclick="location.href='{{url('/login')}}'">Book Now</button>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
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
                                Name: {{ $packageTour ->name }} <br><br>
                                Description: {{$packageTour->description}} <br><br>
                                Duration: {{ $packageTour->duration }} <br><br>
                                Price per adult: {{ $packageTour->price_adult }} <br><br>
                                Price per children: {{ $packageTour->price_children }} <br><br>
                                Itineraries included: <br>
                                @foreach($packageTour->itineraries as $itinerary)
                                    {{$itinerary->name}}
                                    <button type="button" class=" btn btn-primary" onclick="location.href='{{ route('itinerary.show', $itinerary->id) }}'">View</button> <br>
                                @endforeach
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
                        @if($selectedPlacePackageTours)
                            @foreach($selectedPlacePackageTours as $selectedPlacePackageTour)
                                <div class="page-header">
                                    Name: {{ $selectedPlacePackageTour->name }} <br>
                                    Duration: {{ $selectedPlacePackageTour->duration }} <br>
                                    Price per Adult: {{ $selectedPlacePackageTour->price_adult }} <br>
                                    Price per Child: {{ $selectedPlacePackageTour->price_children }} <br>
                                    <button type="button" class="btn btn-primary" onclick="location.href='{{route('packagetour.show', $selectedPlacePackageTour->id)}}'">View</button>
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
                        @if($selectedTypePackageTours)
                            @foreach($selectedTypePackageTours as $selectedTypePackageTour)
                                <div class="page-header">
                                    Name: {{ $selectedTypePackageTour->name }} <br>
                                    Duration: {{ $selectedTypePackageTour->duration }} <br>
                                    Price per Adult: {{ $selectedTypePackageTour->price_adult }} <br>
                                    Price per Child: {{ $selectedTypePackageTour->price_children }} <br>
                                    <button type="button" class="btn btn-primary" onclick="location.href='{{route('packagetour.show', $selectedTypePackageTour->id)}}'">View</button>
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
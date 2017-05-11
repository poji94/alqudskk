@extends('layouts.app')

@section('head')
    View Vacation
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
                                        @foreach($packageTour->itineraries as $itinerary)
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
                                        @endforeach
                                    </ol>

                                    <!-- Wrapper for slides -->
                                    <div class="carousel-inner" role="listbox">
                                        @php
                                            $i = 0;
                                        @endphp
                                        @foreach($packageTour->itineraries as $itinerary)
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
                                Name: {{ $packageTour ->name }} <br><br>
                                Description: {{$packageTour->description}} <br><br>
                                Duration: {{ $packageTour->duration }} <br><br>
                                Price :<br>
                                <div class="responsive-table">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th>Category</th>
                                            <th>Adult</th>
                                            <th>Child</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($packageTour->prices as $price)
                                                <tr>
                                                    <td>Personal</td>
                                                    <td>{{$price->personal}}</td>
                                                    <td>-</td>
                                                </tr>
                                                <tr>
                                                    <td>Private Group</td>
                                                    <td>{{$price->private_group_adult}}</td>
                                                    <td>{{$price->private_group_children}}</td>
                                                </tr>
                                                <tr>
                                                    <td>Public Group</td>
                                                    <td>{{$price->public_group_adult}}</td>
                                                    <td>{{$price->public_group_children}}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                Itineraries: <br>
                                @foreach($packageTour->itineraries as $itinerary)
                                    {{$itinerary->name}}
                                    <button type="button" class=" btn btn-primary" onclick="location.href='{{ route('itinerary.show', $itinerary->id) }}'">View</button> <br>
                                @endforeach
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
    {{--<div class="container">--}}
        {{--<div class="row">--}}
            {{--<div class="col-sm-8 col-md-offset-2">--}}
                {{--<div class="panel panel-default">--}}
                    {{--<div class="panel-heading">Suggestion for places nearby {{$packageTour->places->first()->name}}</div>--}}
                    {{--<div class="panel-body">--}}
                        {{--@if($selectedPlacePackageTours)--}}
                            {{--@foreach($selectedPlacePackageTours as $selectedPlacePackageTour)--}}
                                {{--@if($selectedPlacePackageTour->id == $packageTour->id)--}}

                                {{--@else--}}
                                    {{--<div class="row page-header">--}}
                                        {{--@php--}}
                                            {{--$i = 0;--}}
                                        {{--@endphp--}}
                                        {{--@foreach($selectedPlacePackageTour->itineraries as $itinerary)--}}
                                            {{--@foreach($itinerary->medias as $media)--}}
                                                {{--@if($i == 0)--}}
                                                    {{--<div class="col-sm-4">--}}
                                                        {{--<img src="{{$media->path}}" class="img-responsive img-rounded" alt="" style="height: 150px; width: 230px;">--}}
                                                    {{--</div>--}}
                                                {{--@endif--}}
                                                {{--@php--}}
                                                    {{--$i++;--}}
                                                {{--@endphp--}}
                                            {{--@endforeach--}}
                                        {{--@endforeach--}}
                                        {{--<div class="col-sm-6">--}}
                                            {{--Name: {{ $selectedPlacePackageTour->name }} <br>--}}
                                            {{--Duration: {{ $selectedPlacePackageTour->duration }} <br>--}}
                                            {{--Price per Adult: RM {{ $selectedPlacePackageTour->price_adult }} <br>--}}
                                            {{--Price per Child: RM {{ $selectedPlacePackageTour->price_children }} <br>--}}
                                            {{--<button type="button" class="btn btn-primary" onclick="location.href='{{route('packagetour.show', $selectedPlacePackageTour->id)}}'">View</button>--}}
                                            {{--@if(Auth::guest())--}}
                                                {{--<button type="button" class="btn btn-primary" onclick="location.href='{{url('/login')}}'">Book Now</button>--}}
                                            {{--@else--}}
                                                {{--<button type="button" class="btn btn-primary" onclick="location.href='{{url('/reservation/create')}}'">Book Now</button>--}}
                                            {{--@endif--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                {{--@endif--}}
                            {{--@endforeach--}}
                        {{--@endif--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
    {{--<div class="container">--}}
        {{--<div class="row">--}}
            {{--<div class="col-sm-8 col-md-offset-2">--}}
                {{--<div class="panel panel-default">--}}
                    {{--<div class="panel-heading">Suggestion for similar type: {{$packageTour->types->first()->name}}</div>--}}
                    {{--<div class="panel-body">--}}
                        {{--@if($selectedTypePackageTours)--}}
                            {{--@foreach($selectedTypePackageTours as $selectedTypePackageTour)--}}
                                {{--@if($selectedTypePackageTour->id == $packageTour->id)--}}

                                {{--@else--}}
                                    {{--<div class="row page-header">--}}
                                        {{--@php--}}
                                            {{--$i = 0;--}}
                                        {{--@endphp--}}
                                        {{--@foreach($selectedTypePackageTour->itineraries as $itinerary)--}}
                                            {{--@foreach($itinerary->medias as $media)--}}
                                                {{--@if($i == 0)--}}
                                                    {{--<div class="col-sm-4">--}}
                                                        {{--<img src="{{$media->path}}" class="img-responsive img-rounded" alt="" style="height: 150px; width: 230px;">--}}
                                                    {{--</div>--}}
                                                {{--@endif--}}
                                                {{--@php--}}
                                                    {{--$i++;--}}
                                                {{--@endphp--}}
                                            {{--@endforeach--}}
                                        {{--@endforeach--}}
                                        {{--<div class="col-sm-6">--}}
                                            {{--Name: {{ $selectedTypePackageTour->name }} <br>--}}
                                            {{--Duration: {{ $selectedTypePackageTour->duration }} <br>--}}
                                            {{--Price per Adult: RM {{ $selectedTypePackageTour->price_adult }} <br>--}}
                                            {{--Price per Child: RM {{ $selectedTypePackageTour->price_children }} <br>--}}
                                            {{--<button type="button" class="btn btn-primary" onclick="location.href='{{route('packagetour.show', $selectedTypePackageTour->id)}}'">View</button>--}}
                                            {{--@if(Auth::guest())--}}
                                                {{--<button type="button" class="btn btn-primary" onclick="location.href='{{url('/login')}}'">Book Now</button>--}}
                                            {{--@else--}}
                                                {{--<button type="button" class="btn btn-primary" onclick="location.href='{{url('/reservation/create')}}'">Book Now</button>--}}
                                            {{--@endif--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                {{--@endif--}}
                            {{--@endforeach--}}
                        {{--@endif--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
@endsection
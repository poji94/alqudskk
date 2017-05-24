@extends('layouts.app')

@section('head')
    Activities
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
                    <div class="panel-heading">Activity selection</div>

                    <div class="panel-body">
                        {!! Form::label('title_label', 'Please choose your selection') !!}
                        {!! Form::open(['method'=>'GET', 'action'=> 'ItineraryController@filterSelection']) !!}
                            <div class="row">
                                <div class="col-sm-6 form-group">
                                    {!! Form::label('place_tourism','Location') !!}
                                    {!! Form::select('place_tourism', [''=>'Choose Options'] + $placetourism, null,['class'=>'form-control']) !!}
                                </div>
                                <div class="col-sm-6 form-group">
                                    {!! Form::label('type_vacation','Type of vacation') !!}
                                    {!! Form::select('type_vacation', [''=>'Choose Options'] + $typevacation, null, ['class'=>'form-control']) !!}
                                </div>
                                <div class="col-sm-2 form-group">
                                    {!! Form::submit('Submit', ['class'=>'btn btn-primary']) !!}
                                </div>
                            </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-sm-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">List of activities</div>
                    <div class="panel-body">
                        @if($selectedItineraries)
                            @foreach($selectedItineraries as $selectedItinerary)
                                <div class="row page-header">
                                    @php
                                        $i = 0;
                                    @endphp
                                    @foreach($selectedItinerary->medias as $media)
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
                                        Name: {{ $selectedItinerary->name }} <br>
                                        Duration: {{ $selectedItinerary->duration }} <br>
                                        <button type="button" class="btn btn-primary" onclick="location.href='{{route('itinerary.show', $selectedItinerary->id)}}'">View</button>
                                        @if(Auth::guest())
                                            <button type="button" class="btn btn-primary" onclick="location.href='{{url('/login')}}'">Book Now</button>
                                        @else
                                            <button type="button" class="btn btn-primary" onclick="location.href='{{route('reservation.createItinerary', $selectedItinerary->id)}}'">Book Now</button>
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
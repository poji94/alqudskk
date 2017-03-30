@extends('layouts.app')

@section('head')
    Itineraries
@endsection

@section('content')
    <div class="container" style="padding-top: 75px">
        <div class="row">
            <div class="col-sm-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Itinerary selection</div>

                    <div class="panel-body">
                        Please choose your selection
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
                    <div class="panel-heading">List of itineraries</div>
                    <div class="panel-body">
                        @if($selectedItineraries)
                            @foreach($selectedItineraries as $selectedItinerary)
                                <div class="page-header">
                                    Name: {{ $selectedItinerary->name }} <br>
                                    Duration: {{ $selectedItinerary->duration }} <br>
                                    Price per Adult: {{ $selectedItinerary->price_adult }} <br>
                                    Price per Child: {{ $selectedItinerary->price_children }} <br>
                                    <button type="button" class="btn btn-primary" onclick="location.href='{{route('itinerary.show', $selectedItinerary->id)}}'">View</button>
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
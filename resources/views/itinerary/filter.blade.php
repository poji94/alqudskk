@extends('layouts.backbone')

@section('head')
    Activities
@endsection

@section('styles')
    .carousel-inner > .item > img,
    .carousel-inner > .item > a > img {
        margin: auto;
    }
@endsection

@section('bodyClass')
    index-page
@endsection

@section('content')
    <div class="section" id="backgroundUser" data-parallax="true" style="background-image:url('/preset/backgroundDarken.jpg'); background-size: 100% 100%; background-repeat: no-repeat; height: 100vh;">
        <div class="container" style="margin-top: 35px;">
            <div class="row">
                <div class="col-md-4" style="margin-top: 50px;">
                    <div class="card ">
                        <br>
                        <p class="category" style="color: black; text-align: center;">Activity Selection</p>
                        <br>
                        <div class="card-block">
                            <div class="text-center">
                                {!! Form::label('title_label', 'Please choose your selection') !!}
                            </div>
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
                                </div>
                            <div class="text-center">
                                {!! Form::submit('Submit', ['class'=>'btn btn-primary btn-round']) !!}
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                    <div class="tab-content text-center">
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card" style="height: 70vh;">
                        <br>
                        <p class="category" style="color: black; text-align: center;">List of activites found</p>
                        <br>
                        <div class="card-block" style="height: 70vh; overflow:auto;">
                            <div class="container">
                                <div class="row" >
                                    @if($selectedItineraries)
                                        @foreach($selectedItineraries as $selectedItinerary)
                                                @php
                                                    $i = 0;
                                                @endphp
                                                @foreach($selectedItinerary->medias as $media)
                                                    @if($i == 0)
                                                        <div class="col-sm-4">
                                                            <img src="{{$media->path}}" class="img-responsive img-rounded img-raised" alt="" style="height: 150px; width: 230px;">
                                                            <br><br>
                                                        </div>
                                                    @endif
                                                    @php
                                                        $i++;
                                                    @endphp
                                                @endforeach
                                                <div class="col-sm-6">
                                                    Name: {{ $selectedItinerary->name }} <br>
                                                    <button type="button" class="btn btn-primary btn-round" onclick="location.href='{{route('itinerary.show', $selectedItinerary->id)}}'">View</button>
                                                    @if(Auth::guest())
                                                        <button type="button" class="btn btn-info btn-round" onclick="location.href='{{url('/login')}}'">Book Now</button>
                                                    @else
                                                        <button type="button" class="btn btn-info btn-round" data-toggle="modal" data-target="#option{{$selectedItinerary->id}}">Book Now</button>
                                                        <div class="modal fade" id="option{{$selectedItinerary->id}}" role="dialog">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h4 class="modal-title justify-content-center">Choose option for pickup and dropoff</h4>
                                                                    </div>
                                                                    <div class="row modal-body justify-content-center">
                                                                        <div class="col-sm-10">
                                                                            {!! Form::open(['method'=>'POST', 'action'=> 'ReservationController@createItinerary']) !!}
                                                                            {!! Form::hidden('id', $selectedItinerary->id) !!}
                                                                            @if($selectedItinerary->option2_pickup_place != null)
                                                                                {!! Form::select('option', [''=>'Choose Options', '1'=>'Option 1 ('. $selectedItinerary->option1_pickup_time . ' -> ' . $selectedItinerary->option1_dropoff_time .')', '2'=>'Option 2 ('. $itinerary->option2_pickup_time . ' -> ' . $itinerary->option2_dropoff_time .')'], null, [ 'class'=>'form-control']) !!}
                                                                            @else
                                                                                {!! Form::select('option', [''=>'Choose Options', '1'=>'Option 1 ('. $selectedItinerary->option1_pickup_time . ' -> ' . $selectedItinerary->option1_dropoff_time .')'], null, [ 'class'=>'form-control']) !!}
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer justify-content-center">
                                                                        {!! Form::submit('Book Now', ['class'=>'btn btn-info btn-round']) !!}
                                                                        {!! Form::close() !!}
                                                                        <button type="button" class="btn btn-warning btn-round" data-dismiss="modal">Cancel</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>
                                        @endforeach
                                    @endif
                                </div>
                                <div class="row">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-content text-center">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
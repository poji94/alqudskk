@extends('layouts.app')

@section('head')
    Create Reservation
@endsection

@section('content')
    <div class="container" style="padding-top: 75px">
        <div class="row">
            <div class="col-sm-6 col-md-offset-3">
                <div class="panel panel-default">
                    <div class="panel-heading">Create Reservation</div>

                    <div class="panel-body">
                        {!! Form::open(['method'=>'POST', 'action'=> 'ReservationController@storeItinerary', 'files' => true]) !!}
                        <div class="form-group{{ $errors->has('reservation_type_id') ? ' has-error' : '' }}" style="display: inline-block">
                            {!! Form::hidden('reservation_type_id', 1) !!}
                            {!! Form::label('reservation_type_id_label', 'Type of Reservation:  ') !!}
                            Activity
                        </div>
                        @if($errors->has('itinerary_id'))
                            <div class="alert alert-danger">
                                <ul>
                                    <strong>{{ $errors->first('itinerary_id') }}</strong>
                                </ul>
                            </div>
                        @endif
                        <br>
                        @php
                            $i = 1;
                        @endphp
                        {!! Form::label('itinerary_label', 'Itinerary') !!}<br>
                        @if($reservedItineraries && $reservedItinerariesOption)
                            @foreach($reservedItineraries as $reservedItinerary)
                                @if($reservedDayItineraries[$i] == 1)
                                    <label for="day_itinerary_label">Day {{$reservedDayItineraries[$i]}}</label> ( {{$reservedItinerary['option1_pickup_time']}} -> {{$reservedItinerary['option1_dropoff_time']}} )
                                @elseif($reservedDayitineraries[$i] == 2)
                                    <label for="day_itinerary_label">Day {{$reservedDayItineraries[$i]}}</label> ( {{$reservedItinerary['option2_pickup_time']}} -> {{$reservedItinerary['option2_dropoff_time']}} )
                                @endif
                                <br>
                                {!! Form::label('itinerary_id', 'Activity ' . $i) !!}
                                <div class="row form-group" id="itinerary-form{{$i}}">
                                    <div class="col-sm-9">
                                        <input name="itinerary_id[]" type="hidden" mutltiple="multiple" value="{{$reservedItinerary['id']}}">
                                        <input class="form-control" disabled="disabled" name="itinerary_name[]" type="text" value="{{$reservedItinerary['name']}}" id="itinerary_id">
                                    </div>
                                    <button type="button" class="btn btn-primary" onclick="location.href='{{route('itinerary.show', $reservedItinerary[$i])}}'">View</button>
                                    <button type="button" class="btn btn-danger" onclick="location.href='{{route('reservation.removeItineraryFromSession', $i)}}'">Remove</button>
                                </div>
                                @php
                                    $i++;
                                @endphp
                            @endforeach
                        @endif
                        <div class="form-group">
                            <button type="button" class="btn btn-primary" onclick="location.href='{{route('itinerary.getSelection')}}'">Add Activity</button>
                        </div>
                        <div class="form-group{{ $errors->has('price_type') ? ' has-error' : '' }}" style="display: inline-block">
                            {!! Form::label('price_type_label', 'Please choose:  ') !!}
                            <label class="radio-inline">
                                {!! Form::radio('price_type', 'personal', false, ['id'=>'personal', 'style'=>'display:inline-block']) !!}
                                Personal
                            </label>
                            <label class="radio-inline">
                                {!! Form::radio('price_type', 'private_group', false, ['id'=>'private_group', 'style'=>'display:inline-block']) !!}
                                Private Group
                            </label>
                            <label class="radio-inline">
                                {!! Form::radio('price_type', 'public_group', false, ['id'=>'public_group', 'style'=>'display:inline-block']) !!}
                                Public Group
                            </label>
                            @if ($errors->has('price_type'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('price_type') }}</strong>
                                    </span>
                            @endif

                            <script type="text/javascript">
                                $(document).ready(function () {
                                    $("#adult_no").hide();
                                    $("#children_no").hide();
                                    $("#personal").click(function(){
                                        $("#adult_no").slideUp();
                                        $("#children_no").slideUp();
                                    });
                                    $("#private_group").click(function(){
                                        $("#adult_no").slideDown();
                                        $("#children_no").slideDown();
                                    });
                                    $("#public_group").click(function(){
                                        $("#adult_no").slideDown();
                                        $("#children_no").slideDown();
                                    });
                                });
                            </script>
                        </div>
                        <div class="row">
                            <div id="adult_no" class="col-sm-6 form-group{{ $errors->has('adult_no') ? ' has-error' : '' }}">
                                {!! Form::label('adult_no', 'Number of adult') !!}
                                {!! Form::number('adult_no', 1, ['class'=>'form-control']) !!}
                                @if ($errors->has('adult_no'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('adult_no') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div id="children_no" class="col-sm-6 form-group{{ $errors->has('children_no') ? ' has-error' : '' }}">
                                {!! Form::label('children_no', 'Number of children') !!}
                                {!! Form::number('children_no', 1, ['class'=>'form-control']) !!}
                                @if ($errors->has('children_no'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('children_no') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6 form-group{{ $errors->has('main_reservation_start') ? ' has-error' : '' }}">
                                {!! Form::label('main_reservation_start_label', 'Start date') !!}
                                {!! Form::date('main_reservation_start', null, ['class'=>'form-control', 'min'=>\Carbon\Carbon::today()->toDateString(), 'onkeydown'=>'return false']) !!}
                                @if ($errors->has('main_reservation_start'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('main_reservation_start') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-sm-6 form-group{{ $errors->has('alternate_reservation_start') ? ' has-error' : '' }}">
                                {!! Form::label('alternate_reservation_start_label', 'Alternative start date') !!}
                                {!! Form::date('alternate_reservation_start', null, ['class'=>'form-control', 'min'=>\Carbon\Carbon::today()->toDateString(), 'onkeydown'=>'return false']) !!}
                                @if ($errors->has('alternate_reservation_start'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('alternate_reservation_start') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('other_details') ? ' has-error' : '' }}">
                            {!! Form::label('other_details_label', 'Other details:') !!}
                            {!! Form::textarea('other_details', null, ['class'=>'form-control', 'rows'=>'4', 'placeholder'=>'Any information regarding the reserved activities']) !!}
                            @if ($errors->has('other_details'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('other_details') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            {!! Form::submit('Create Reservation', ['class'=>'btn btn-primary']) !!}
                            <button type="button" class="btn btn-primary" onclick="location.href='{{url()->previous()}}'">Cancel</button>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
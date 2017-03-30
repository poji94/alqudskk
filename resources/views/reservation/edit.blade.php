@extends('layouts.app')

@section('head')
    View Reservation
@endsection

@section('content')
    <div class="container" style="padding-top: 75px">
        <div class="row">
            <div class="col-sm-6 col-md-offset-3">
                <div class="panel panel-default">
                    <div class="panel-heading">View Reservation</div>

                    <div class="panel-body">
                        {!! Form::model($reservation, ['method'=>'PATCH', 'action'=> ['ReservationController@update', $reservation->id], 'files' => true]) !!}
                        <div class="form-group{{ $errors->has('reservation_type_id') ? ' has-error' : '' }}" style="display: inline-block">
                            {!! Form::label('reservation_type_id_label', 'Type of Reservation:  ') !!}

                            @if($reservation->reservation_type_id == 1)
                                <label class="radio-inline">
                                    {!! Form::radio('reservation_type_id', 1, true, ['id'=>'ground', 'style'=>'display:inline-block']) !!}
                                    Ground
                                </label>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#add-itinerary").show();
                                        $("#package-tour-form").hide();
                                    });
                                </script>
                            @elseif($reservation->reservation_type_id == 2)
                                <label class="radio-inline">
                                    {!! Form::radio('reservation_type_id', 2, false, ['id'=>'full_boat', 'style'=>'display:inline-block']) !!}
                                    Full Boat
                                </label>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#add-itinerary").hide();
                                        $("#package-tour-form").show();
                                    });
                                </script>
                            @endif
                        </div>
                        <div class="row form-group" id="itinerary-form">
                            {!! Form::label('itinerary_id', 'Itinerary', ['class'=>'col-sm-2']) !!}
                            {!! Form::select('itinerary_id[]', $itineraries, null, ['class'=>'col-sm-4', 'multiple'=>'multiple']) !!}
                            <input type="button" class="btn btn-danger" id="remove-itinerary" value="Remove">
                        </div>
                        @foreach($reservation->itineraries as $itinerary)
                            <div class="row form-group" id="itinerary-form{{$i}}">
                                {!! Form::label('itinerary_id', 'Itinerary', ['class'=>'col-sm-2']) !!}
                                {!! Form::select('itinerary_id[]', $itineraries, $itinerary->id, ['class'=>'col-sm-4', 'multiple'=>'multiple']) !!}
                                <input type="button" class=" btn btn-danger" id="remove-itinerary{{$i}}" value="Remove">
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#remove-itinerary" + "<?php echo $i ?>").click(function () {
                                            $(this).closest("div").remove();
                                        });
                                    });
                                </script>
                            </div>
                            @php
                                $i++;
                            @endphp
                        @endforeach
                        <p>
                            <input type="button" class="btn btn-primary" id="add-itinerary" value="Add Itinerary">
                            <script type="text/javascript">
                                $(document).ready(function () {
                                    $("#itinerary-form").hide();
                                    var itineraryFormIndex = "<?php echo $i ?>";
                                    $("#add-itinerary").click(function(){
                                        itineraryFormIndex++;
                                        $(this).parent().before($("#itinerary-form").clone().attr("id", "itinerary-form" + itineraryFormIndex));
                                        $("#itinerary-form" + itineraryFormIndex +" :input").each(function () {
                                            $(this).attr("name", $(this).attr("name") + itineraryFormIndex);
                                            $(this).attr("id", $(this).attr("id") + itineraryFormIndex);
                                        });
                                        $("#remove-itinerary" + itineraryFormIndex).click(function () {
                                            $(this).closest("div").remove();
                                        });
                                        $("#itinerary-form" + itineraryFormIndex).slideDown();
                                    });
                                });
                            </script>
                        </p>
                        @foreach($reservation->packageTour as $packagetour)
                            <div class="form-group" id="package-tour-form">
                                {!! Form::label('packagetour_id', 'Tour Package') !!}
                                {!! Form::select('packagetour_id', [''=>'Choose Options'] + $packagetours, $packagetour->id, ['class'=>'form-control']) !!}
                            </div>
                        @endforeach
                         <div class="row">
                             <div class="col-sm-6 form-group{{ $errors->has('children_no') ? ' has-error' : '' }}">
                                 {!! Form::label('children_no', 'Number of children') !!}
                                 {!! Form::number('children_no', null, ['class'=>'form-control']) !!}
                                 @if ($errors->has('children_no'))
                                     <span class="help-block">
                                        <strong>{{ $errors->first('children_no') }}</strong>
                                    </span>
                                 @endif
                             </div>
                             <div class="col-sm-6 form-group{{ $errors->has('adult_no') ? ' has-error' : '' }}">
                                 {!! Form::label('adult_no', 'Price per adult') !!}
                                 {!! Form::number('adult_no', null, ['class'=>'form-control']) !!}
                                 @if ($errors->has('adult_no'))
                                     <span class="help-block">
                                        <strong>{{ $errors->first('adult_no') }}</strong>
                                    </span>
                                 @endif
                             </div>
                         </div>

                        <div class="row">
                            <div class="col-sm-6 form-group{{ $errors->has('reservation_start') ? ' has-error' : '' }}">
                                {!! Form::label('reservation_start', 'Start date') !!}
                                {!! Form::date('reservation_start', null, ['class'=>'form-control']) !!}
                                @if ($errors->has('reservation_start'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('reservation_start') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-sm-6 form-group">
                                {!! Form::label('reservation_end', 'Estimated end date') !!}
                                {!! Form::date('reservation_end', null, ['class'=>'form-control', 'readonly']) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            {!! Form::label('price', 'Price') !!}
                            {!! Form::text('price', $reservation->price, ['class'=>'form-control', 'readonly']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::submit('Edit Reservation', ['class'=>'btn btn-primary']) !!}
                        </div>
                        {!! Form::close() !!}
                        <div class="form-group">
                            {!!  Form::open(['method' => 'DELETE', 'action' => ['ReservationController@destroy', $reservation->id]])!!}
                            {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                            {!! Form::close() !!}
                        </div>
                        <button type="button" class="btn btn-primary" onclick="location.href='{{route('reservation.index')}}'">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


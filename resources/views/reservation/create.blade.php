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
                        {!! Form::open(['method'=>'POST', 'action'=> 'ReservationController@store', 'files' => true]) !!}
                        <div class="form-group{{ $errors->has('reservation_type_id') ? ' has-error' : '' }}" style="display: inline-block">
                            {!! Form::label('reservation_type_id_label', 'Type of Reservation:  ') !!}

                            {{--<label class="radio-inline">--}}
                                {{--{!! Form::radio('reservation_type_id', 1, true, ['id'=>'ground', 'style'=>'display:inline-block']) !!}--}}
                                {{--Activities--}}
                            {{--</label>--}}

                            <label class="radio-inline">
                                {!! Form::radio('reservation_type_id', 2, false, ['id'=>'full_boat', 'style'=>'display:inline-block']) !!}
                                Tour package
                            </label>
                            @if ($errors->has('reservation_type_id'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('reservation_type_id') }}</strong>
                                    </span>
                            @endif

                            <script type="text/javascript">
                                $(document).ready(function () {
                                    $("#add-itinerary").hide();
                                    $("#package-tour-form").hide();
                                    $("#ground").click(function(){
                                        $("#add-itinerary").slideDown();
                                        $("#package-tour-form").slideUp();
                                    });
                                    $("#full_boat").click(function(){
                                        $("#package-tour-form").slideDown();
                                        $("#add-itinerary").slideUp();
                                    });

                                });
                            </script>
                        </div>
                        <div class="row form-group" id="itinerary-form">
                            {!! Form::label('itinerary_id', 'Itinerary', ['class'=>'col-sm-2']) !!}
                            {!! Form::select('itinerary_id[]', $itineraries, null, ['class'=>'col-sm-4', 'multiple'=>'multiple']) !!}
                            <input type="button" class="btn btn-danger" id="remove-itinerary" value="Remove">
                        </div>
                        <p>
                            <input type="button" class="btn btn-primary" id="add-itinerary" value="Add Activity">
                            <script type="text/javascript">
                                $(document).ready(function () {
                                    $("#itinerary-form").hide();
                                    var itineraryFormIndex = 0;
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
                        <div class="form-group" id="package-tour-form">
                            {!! Form::label('packagetour_id', 'Tour Package') !!}
                            {!! Form::select('packagetour_id', [''=>'Choose Options'] + $packagetours, null, ['class'=>'form-control']) !!}
                        </div>
                        <div class="row">
                            <div class="col-sm-6 form-group{{ $errors->has('children_no') ? ' has-error' : '' }}">
                            {!! Form::label('children_no', 'Number of children') !!}
                                {!! Form::number('children_no', 0, ['class'=>'form-control']) !!}
                                @if ($errors->has('children_no'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('children_no') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-sm-6 form-group{{ $errors->has('adult_no') ? ' has-error' : '' }}">
                                {!! Form::label('adult_no', 'Price per adult') !!}
                                {!! Form::number('adult_no', 0, ['class'=>'form-control']) !!}
                                @if ($errors->has('adult_no'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('adult_no') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('reservation_start') ? ' has-error' : '' }}">
                            {!! Form::label('reservation_start', 'Start date') !!}
                            {!! Form::date('reservation_start', \Carbon\Carbon::now(), ['class'=>'form-control']) !!}
                            @if ($errors->has('reservation_start'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('reservation_start') }}</strong>
                                    </span>
                            @endif
                        </div>
                        <div class="form-group">
                            {!! Form::submit('Create Reservation', ['class'=>'btn btn-primary']) !!}
                            <button type="button" class="btn btn-primary" onclick="location.href='{{route('reservation.index')}}'">Cancel</button>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@extends('layouts.master')

<script src="{{asset('/js/jquery.js')}}"></script>

{!! Form::open(['method'=>'POST', 'action'=> 'ReservationController@store', 'files' => true]) !!}
<div class="form-group">
    {!! Form::label('reservation_type_id_label', 'Type of Reservation:  ') !!}

    {!! Form::radio('reservation_type_id', 1, false, ['class'=>'form-control', 'id'=>'ground']) !!}
    {!! Form::label('reservation_type_id', 'Ground') !!}

    {!! Form::radio('reservation_type_id', 2, false, ['class'=>'form-control', 'id'=>'full_boat']) !!}
    {!! Form::label('reservation_type_id', 'Full Boat') !!}

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
<div class="form-group">
    {!! Form::label('reservation_start', 'Start date') !!}
    {!! Form::date('reservation_start', \Carbon\Carbon::now(), ['class'=>'form-control']) !!}
</div>
<div class="form-group" id="itinerary-form">
    {!! Form::label('itinerary_id', 'Itinerary') !!}
    {!! Form::select('itinerary_id[]', $itineraries, null, ['class'=>'form-control', 'multiple'=>'multiple']) !!}
    <input type="button" id="remove-itinerary" value="Remove">
</div>
<p>
    <input type="button" id="add-itinerary" value="Add Itinerary">
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
<div class="form-group">
    {!! Form::label('children_no', 'Number of children') !!}
    {!! Form::number('children_no', 0, ['class'=>'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('adult_no', 'Price per adult') !!}
    {!! Form::number('adult_no', 0, ['class'=>'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::submit('Create Reservation', ['class'=>'btn btn-primary']) !!}
</div>
{!! Form::close() !!}

<button type="button" onclick="location.href='{{route('reservation.index')}}'">Cancel</button>

@include('includes.form_error')
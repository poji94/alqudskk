@extends('layouts.master')

<script src="{{asset('/js/jquery.js')}}"></script>

{!! Form::model($reservation, ['method'=>'PATCH', 'action'=> ['ReservationController@update', $reservation->id], 'files' => true]) !!}
<div class="form-group">
    {!! Form::label('reservation_type_id_label', 'Type of Reservation:  ') !!}

    @if($reservation->reservation_type_id == 1)
        {!! Form::radio('reservation_type_id', $reservation->reservation_type_id, true, ['class'=>'form-control', 'id'=>'ground']) !!}
        {!! Form::label('reservation_type_id', $reservation->reserveType->name) !!}
        <script type="text/javascript">
            $(document).ready(function () {
                $("#add-itinerary").show();
                $("#package-tour-form").hide();
            });
        </script>
    @elseif($reservation->reservation_type_id == 2)
        {!! Form::radio('reservation_type_id', $reservation->reservation_type_id, true, ['class'=>'form-control', 'id'=>'full_boat']) !!}
        {!! Form::label('reservation_type_id', $reservation->reserveType->name) !!}
        <script type="text/javascript">
            $(document).ready(function () {
                $("#add-itinerary").hide();
                $("#package-tour-form").show();
            });
        </script>
    @endif
</div>
<div class="form-group">
    {!! Form::label('reservation_start', 'Start date') !!}
    {!! Form::date('reservation_start', null, ['class'=>'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('reservation_end', 'Estimated end date') !!}
    {!! Form::date('reservation_end', null, ['class'=>'form-control', 'readonly']) !!}
</div>

<div class="form-group" id="itinerary-form">
    {!! Form::label('itinerary_id', 'Itinerary') !!}
    {!! Form::select('itinerary_id[]', $itineraries, null, ['class'=>'form-control', 'multiple'=>'multiple']) !!}
    <input type="button" id="remove-itinerary" value="Remove">
</div>
@foreach($reservation->itineraries as $itinerary)
    <div class="form-group" id="itinerary-form{{$i}}">
        {!! Form::label('itinerary_id', 'Itinerary') !!}
        {!! Form::select('itinerary_id[]', $itineraries, $itinerary->id, ['class'=>'form-control', 'multiple'=>'multiple']) !!}
        <input type="button" id="remove-itinerary{{$i}}" value="Remove">
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
    <input type="button" id="add-itinerary" value="Add Itinerary">
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
<div class="form-group">
    {!! Form::label('price', 'Price') !!}
    {!! Form::text('price', $reservation->price, ['class'=>'form-control', 'readonly']) !!}
</div>
<div class="form-group">
    {!! Form::label('children_no', 'Number of children') !!}
    {!! Form::number('children_no', null, ['class'=>'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('adult_no', 'Price per adult') !!}
    {!! Form::number('adult_no', null, ['class'=>'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::submit('Edit Reservation', ['class'=>'btn btn-primary']) !!}
</div>
{!! Form::close() !!}

<button type="button" onclick="location.href='{{route('reservation.index')}}'">Cancel</button>

@include('includes.form_error')
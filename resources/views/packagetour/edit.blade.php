@extends('layouts.master')

<script src="{{asset('/js/jquery.js')}}"></script>


{!! Form::model($packagetour, ['method'=>'PATCH', 'action'=> ['PackageTourController@update', $packagetour->id], 'files' => true]) !!}
<div class="form-group">
    {!! Form::label('name', 'Name') !!}
    {!! Form::text('name', null, ['class'=>'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('description', 'Description') !!}
    {!! Form::text('description', null, ['class'=>'form-control']) !!}
</div>
<div class="form-group" id="itinerary-form">
    {!! Form::label('itinerary_id', 'Itinerary') !!}
    {!! Form::select('itinerary_id[]', $itineraries, null, ['class'=>'form-control', 'multiple'=>'multiple']) !!}
    <input type="button" id="remove-itinerary" value="Remove">
</div>
@foreach($packagetour->itineraries as $itinerary)
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
<div class="form-group">
    {!! Form::label('duration', 'Duration') !!}
    {!! Form::text('duration', null, ['class'=>'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('price_children', 'Price per child') !!}
    {!! Form::number('price_children', null, ['class'=>'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('price_adult', 'Price per adult') !!}
    {!! Form::number('price_adult', null, ['class'=>'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::submit('Edit Tour Package', ['class'=>'btn btn-primary']) !!}
</div>
{!! Form::close() !!}

<button type="button" onclick="location.href='{{route('packagetour.index')}}'">Cancel</button>

@include('includes.form_error')
@extends('layouts.master')

<script src="{{asset('/js/jquery.js')}}"></script>

{!! Form::open(['method'=>'POST', 'action'=> 'ItineraryController@store', 'files' => true]) !!}
<div class="form-group">
    {!! Form::label('name', 'Name') !!}
    {!! Form::text('name', null, ['class'=>'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('description', 'Description') !!}
    {!! Form::text('description', null, ['class'=>'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('place_tourism','Location') !!}
    {!! Form::select('place_tourism', [''=>'Choose Options'] + $placetourism, null, ['class'=>'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('type_vacation','Type of vacation') !!}
    {!! Form::select('type_vacation', [''=>'Choose Options'] + $typevacation, null, ['class'=>'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('duration', 'Duration') !!}
    {!! Form::text('duration', null, ['class'=>'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('price', 'Price') !!}
    {!! Form::number('price', null, ['class'=>'form-control']) !!}
</div>
<div class="form-group" id="media-form">
    {!! Form::label('media_id', 'Media') !!}
    {!! Form::file('media_id_reference', array('multiple'=>'multiple', 'accept'=>'image/*')) !!}
    <input type="button" id="remove-media" value="Remove">
</div>
<p>
    <input type="button" id="add-media" value="Add media">
    <script type="text/javascript">
        $(document).ready(function () {
            $("#media-form").hide();
            var mediaFormIndex = 0;
            $("#add-media").click(function(){
                mediaFormIndex++;
                $(this).parent().before($("#media-form").clone().attr("id", "media-form" + mediaFormIndex));
                $("#media-form" + mediaFormIndex +" :input").each(function () {
                    $(this).attr("name", "media_id[]");
                    $(this).attr("id", $(this).attr("id") + mediaFormIndex);
                });
                $("#remove-media" + mediaFormIndex).click(function () {
                    $(this).closest("div").remove();
                });
                $("#media-form" + mediaFormIndex).slideDown();
            });
        });
    </script>
</p>
<div class="form-group">
    {!! Form::submit('Create Itinerary', ['class'=>'btn btn-primary']) !!}
</div>
{!! Form::close() !!}

<button type="button" onclick="location.href='{{route('itinerary.index')}}'">Cancel</button>

@include('includes.form_error')
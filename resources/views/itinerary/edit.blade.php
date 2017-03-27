@extends('layouts.master')

<script src="{{asset('/js/jquery.js')}}"></script>

{!! Form::model($itinerary, ['method'=>'PATCH', 'action'=> ['ItineraryController@update', $itinerary->id], 'files' => true]) !!}
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
    {!! Form::select('place_tourism', [''=>'Choose Options'] + $placetourism, $place_tourism, ['class'=>'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('type_vacation','Type of vacation') !!}
    {!! Form::select('type_vacation', [''=>'Choose Options'] + $typevacation, $type_vacation, ['class'=>'form-control']) !!}
</div>
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
<div class="form-group" id="media-form">
    {!! Form::label('media_id', 'Media') !!}
    {!! Form::file('media_id_reference', array('multiple'=>'multiple', 'accept'=>'image/*')) !!}
    <input type="button" id="remove-media" value="Remove">
</div>
@foreach($itinerary->medias as $media)
    <div class="form-group" id="media-form">
        {!! Form::label('media_id', 'Media') !!}
        {!! Form::file('media_id[]', array('multiple'=>'multiple', 'accept'=>'image/*')) !!}
        <input type="button" id="remove-media" value="Remove">
        <script>
            $("#remove-media" + mediaFormIndex).click(function () {
                $(this).closest("div").remove();
            });
        </script>
    </div>
@endforeach
<p>
    <input type="button" id="add-media" value="Add Media">
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

</p>
<div class="form-group">
    {!! Form::submit('Edit Itinerary', ['class'=>'btn btn-primary']) !!}
</div>
{!! Form::close() !!}

<button type="button" onclick="location.href='{{route('itinerary.index')}}'">Cancel</button>

@include('includes.form_error')
@extends('layouts.master')

{{--<script src="{{asset('/js/jquery.js')}}"></script>--}}
{{--<script type="text/javascript">--}}
    {{--$(document).ready(function () {--}}
        {{--var itineraryFormIndex = 0;--}}
        {{--$("#add-itinerary").click(function(){--}}
            {{--itineraryFormIndex++;--}}
            {{--$(this).parent().before($("#itinerary-form").clone().attr("id", "itinerary-form" + itineraryFormIndex));--}}
            {{--$("#itinerary-form" + itineraryFormIndex +" :input").each(function () {--}}
                {{--$(this).attr("name", $(this).attr("name") + itineraryFormIndex);--}}
                {{--$(this).attr("id", $(this).attr("id") + itineraryFormIndex);--}}
            {{--});--}}
            {{--$("#remove-itinerary" + itineraryFormIndex).click(function () {--}}
               {{--$(this).closest("div").remove();--}}
            {{--});--}}
        {{--});--}}
    {{--});--}}
{{--</script>--}}

{!! Form::open(['method'=>'POST', 'action'=> 'PackageTourController@store', 'files' => true]) !!}
<div class="form-group">
    {!! Form::label('name', 'Name') !!}
    {!! Form::text('name', null, ['class'=>'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('description', 'Description') !!}
    {!! Form::text('description', null, ['class'=>'form-control']) !!}
</div>
{{--<div class="form-group" id="itinerary-form">--}}
    {{--{!! Form::label('itinerary_id', 'Itinerary') !!}--}}
    {{--{!! Form::select('itinerary_id', [''=>'Choose Options'] + $itineraries, null, ['class'=>'form-control']) !!}--}}
    {{--<input type="button" id="remove-itinerary" value="Remove">--}}
{{--</div>--}}
{{--<p>--}}
    {{--<input type="button" id="add-itinerary" value="Add Itinerary">--}}
{{--</p>--}}
<div class="form group">
    {!! Form::label('itineraries_number', 'Number of itineraries') !!}
    {!! Form::number('itineraries_number', null, ['class'=>'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('duration', 'Duration') !!}
    {!! Form::text('duration', null, ['class'=>'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('price', 'Price') !!}
    {!! Form::number('price', null, ['class'=>'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::submit('Create Tour Package', ['class'=>'btn btn-primary']) !!}
</div>
{!! Form::close() !!}

<button type="button" onclick="location.href='{{route('packagetour.index')}}'">Cancel</button>

@include('includes.form_error')
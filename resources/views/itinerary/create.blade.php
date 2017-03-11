@extends('layouts.master')

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
    {!! Form::label('duration', 'Duration') !!}
    {!! Form::text('duration', null, ['class'=>'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('price', 'Price') !!}
    {!! Form::number('price', null, ['class'=>'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::submit('Create Itinerary', ['class'=>'btn btn-primary']) !!}
</div>
{!! Form::close() !!}

<button type="button" onclick="location.href='{{route('itinerary.index')}}'">Cancel</button>

@include('includes.form_error')
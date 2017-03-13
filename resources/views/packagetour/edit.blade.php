@extends('layouts.master')

{!! Form::model($packagetour, ['method'=>'PATCH', 'action'=> ['PackageTourController@update', $packagetour->id], 'files' => true]) !!}
<div class="form-group">
    {!! Form::label('name', 'Name') !!}
    {!! Form::text('name', null, ['class'=>'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('description', 'Description') !!}
    {!! Form::text('description', null, ['class'=>'form-control']) !!}
</div>
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
    {!! Form::submit('Edit Tour Package', ['class'=>'btn btn-primary']) !!}
</div>
{!! Form::close() !!}

<button type="button" onclick="location.href='{{route('packagetour.index')}}'">Cancel</button>

@include('includes.form_error')
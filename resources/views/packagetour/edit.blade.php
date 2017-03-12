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
<div class="form-group">
    @php
        $count = 0;
    @endphp
    @foreach($packagetour->itineraries as $itinerary)
            {!! Form::label('itinerary_id' . $count, 'Itinerary') !!}
            {!! Form::select('itinerary_id' . $count, [''=>'Choose Options'] + $itineraries, $itinerary->pivot->itinerary_id, ['class'=>'form-control']) !!}
            <br>
        @php
            $count += 1;
        @endphp
    @endforeach
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
@extends('layouts.master')

{!! Form::model($packagetour, ['method'=>'PATCH', 'action'=> ['PackageTourController@storeItineraries', $packagetour->id], 'files' => true]) !!}
    {!! Form::hidden('id', $packagetour->id) !!}
    {!! Form::hidden('count', $count) !!}
@for($i = 0; $i < $count; $i++)
    {!! Form::label('itinerary_id' . $i, 'Itinerary') !!}
    {!! Form::select('itinerary_id' . $i, [''=>'Choose Options'] + $itineraries, null, ['class'=>'form-control']) !!}
    <br>
@endfor
<div class="form-group">
    {!! Form::submit('Submit', ['class'=>'btn btn-primary']) !!}
</div>
{!! Form::close() !!}
@extends('layouts.master')

{!! Form::model($packagetour, ['method'=>'PATCH', 'action'=> ['PackageTourController@storeItineraries', $packagetour->id], 'files' => true]) !!}
{!! Form::hidden('id', $packagetour->id) !!}

@if($packagetour->itineraries)
    @for($i = 0; $i < $packagetour->itineraries_number; $i++)
        {!! Form::label('itinerary_id' . $i, 'Itinerary') !!}
        {!! Form::select('itinerary_id' . $i, [''=>'Choose Options'] + $itineraries, null, ['class'=>'form-control']) !!}
        <br>
        @php
            $packagetour->itineraties()->next();
        @endphp
    @endfor
@endif
<div class="form-group">
    {!! Form::submit('Submit', ['class'=>'btn btn-primary']) !!}
</div>
{!! Form::close() !!}

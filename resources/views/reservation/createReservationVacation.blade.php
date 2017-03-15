@extends('layouts.master')

{!! Form::model($reservation, ['method'=>'PATCH', 'action'=> ['ReservationController@storeReservationVacation', $reservation->id], 'files' => true]) !!}
{!! Form::hidden('id', $reservation->id) !!}

@if($reservation->reservation_type_id == 2)
    {!! Form::label('package_tour_id', 'Tour package') !!}
    {!! Form::select('package_tour_id', [''=>'Choose Options'] + $packagetours, null, ['class'=>'form-control']) !!}
@endif
{{--@for($i = 0; $i < $packagetour->itineraries_number; $i++)--}}
    {{--{!! Form::label('itinerary_id' . $i, 'Itinerary') !!}--}}
    {{--{!! Form::select('itinerary_id' . $i, [''=>'Choose Options'] + $itineraries, null, ['class'=>'form-control']) !!}--}}
    {{--<br>--}}
{{--@endfor--}}
<div class="form-group">
    {!! Form::submit('Submit', ['class'=>'btn btn-primary']) !!}
</div>
{!! Form::close() !!}
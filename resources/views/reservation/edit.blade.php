@extends('layouts.master')

{!! Form::model($reservation, ['method'=>'PATCH', 'action'=> ['ReservationController@update', $reservation->id], 'files' => true]) !!}
<div class="form-group">
    {!! Form::label('reservation_type_id', 'Type of Reservation:  ') !!}

    @if($reservation->reservation_type_id == 1)
        {!! Form::radio('reservation_type_id', 1, true, ['class'=>'form-control']) !!}
        {!! Form::label('reservation_type_id_label', 'Ground') !!}
    @endif

    @if($reservation->reservation_type_id == 2)
        {!! Form::radio('reservation_type_id', 2, true, ['class'=>'form-control']) !!}
        {!! Form::label('reservation_type_id_label', 'Full boat') !!}
    @endif
</div>
<div class="form-group">
    {!! Form::label('reservation_start', 'Start date') !!}
    {!! Form::date('reservation_start', $reservation->reservation_start, ['class'=>'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('reservation_end', 'End date') !!}
    {!! Form::date('reservation_end', $reservation->reservation_end, ['class'=>'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::submit('Edit Reservation', ['class'=>'btn btn-primary']) !!}
</div>
{!! Form::close() !!}

<button type="button" onclick="location.href='{{route('reservation.index')}}'">Cancel</button>

@include('includes.form_error')
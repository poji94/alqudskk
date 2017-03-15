@extends('layouts.master')

{!! Form::open(['method'=>'POST', 'action'=> 'ReservationController@store', 'files' => true]) !!}
<div class="form-group">
    {!! Form::label('reservation_type_id', 'Type of Reservation:  ') !!}

    {!! Form::radio('reservation_type_id', 1, false, ['class'=>'form-control']) !!}
    {!! Form::label('reservation_type_id_label', 'Ground') !!}

    {!! Form::radio('reservation_type_id', 2, false, ['class'=>'form-control']) !!}
    {!! Form::label('reservation_type_id_label', 'Full boat') !!}
</div>
<div class="form-group">
    {!! Form::label('reservation_start', 'Start date') !!}
    {!! Form::date('reservation_start', \Carbon\Carbon::now(), ['class'=>'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('reservation_end', 'End date') !!}
    {!! Form::date('reservation_end', \Carbon\Carbon::now(), ['class'=>'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::submit('Create Reservation', ['class'=>'btn btn-primary']) !!}
</div>
{!! Form::close() !!}

<button type="button" onclick="location.href='{{route('reservation.index')}}'">Cancel</button>

@include('includes.form_error')
@extends('layouts.app')

@section('head')
    View Reservation
@endsection

@section('content')
    <div class="container" style="padding-top: 75px">
        <div class="row">
            <div class="col-sm-6 col-md-offset-3">
                <div class="panel panel-default">
                    <div class="panel-heading">View Reservation</div>

                    <div class="panel-body">
                        <div class="form-group{{ $errors->has('reservation_type_id') ? ' has-error' : '' }}" style="display: inline-block">
                            {!! Form::hidden('reservation_type_id', 2) !!}
                            {!! Form::label('reservation_type_id_label', 'Type of Reservation:  ') !!}
                            Tour package
                        </div>
                        <div class="form-group">
                            {!! Form::label('user_name', 'User Name: ') !!}
                            {{$reservation->reserveUser->name}}<br>
                            {!! Form::label('user_email', 'Email: ') !!}
                            {{$reservation->reserveUser->email}}<br>
                            {!! Form::label('user_email', 'Phone Number: ') !!}
                            {{$reservation->reserveUser->phone_number}}
                        </div>
                        <div class="form-group">
                            {!! Form::label('reservation_status_label', 'Status:  ') !!}
                            {{$reservation->reserveStatus->name}}
                        </div>
                        @php
                            $i = 1;
                        @endphp
                        @foreach($reservation->packageTours as $packagetour)
                            <div class="form-group" id="package-tour-form">
                                {!! Form::label('packagetour_id', 'Tour Package ' . $i . ': ') !!}
                                {{$packagetour->name}}
                            </div>
                            @php
                                $i++;
                            @endphp
                        @endforeach
                        <div class="form-group{{ $errors->has('price_type') ? ' has-error' : '' }}" style="display: inline-block">
                            {!! Form::label('price_type_label', 'Type: ') !!}
                            @if($reservation->price_type == 'personal')
                                Personal
                            @elseif($reservation->price_type == 'private_group')
                                Private Group
                            @elseif($reservation->price_type == 'public_group')
                                Public Group
                            @endif
                        </div>
                        @if($reservation->price_type == 'personal')
                            <div class="row">
                                <div id="adult_no" class="col-sm-6 form-group{{ $errors->has('adult_no') ? ' has-error' : '' }}">
                                    {!! Form::label('adult_no', 'Number of adult: ') !!}
                                    {{$reservation->adult_no}}
                                </div>
                            </div>
                        @else
                            <div class="row">
                                <div id="adult_no" class="col-sm-6 form-group{{ $errors->has('adult_no') ? ' has-error' : '' }}">
                                    {!! Form::label('adult_no', 'Number of adult: ') !!}
                                    {{$reservation->adult_no}}
                                </div>
                                <div id="children_no" class="col-sm-6 form-group{{ $errors->has('children_no') ? ' has-error' : '' }}">
                                    {!! Form::label('children_no', 'Number of children: ') !!}
                                    {{$reservation->children_no}}
                                </div>
                            </div>
                        @endif
                        <div class="row">
                            <div class="col-sm-6 form-group{{ $errors->has('reservation_start') ? ' has-error' : '' }}">
                                {!! Form::label('reservation_start', 'Start date: ') !!}
                                {{$reservation->reservation_start}}
                            </div>
                            <div class="col-sm-6 form-group">
                                {!! Form::label('reservation_end', 'End date: ') !!}
                                {{$reservation->reservation_end}}
                            </div>
                        </div>
                        <div class="form-group">
                            {!! Form::label('price', 'Price: ') !!}
                            {{currency($reservation->price, currency()->config('default'), $currency['code'])}}
                        </div>
                        @if($reservation->other_details != null)
                            <div class="from-group">
                                {!! Form::label('other_details_label', 'Other details from user: ') !!}<br>
                                {{ $reservation->other_details }}<br><br>
                            </div>
                        @endif
                        @if($reservation->reserveStatus->id != 2)
                            <div class="form-group">
                                {!! Form::label('remarks_label', 'Remark: ') !!}<br>
                                {{ $reservation->remarks }}<br>
                            </div>
                            <div class="form-group">
                                {!! Form::label('reviewer_name', 'More info, please enquire: ') !!}<br>
                                {{$remarksBy->name}}<br>
                                {!! Form::label('user_email', 'Email: ') !!}
                                {{$remarksBy->email}}<br>
                                {!! Form::label('user_email', 'Phone Number: ') !!}
                                {{$remarksBy->phone_number}}
                            </div>
                        @endif
                        <div class="form-group">
                            <button type="button" class="btn btn-primary" onclick="location.href='{{url()->previous()}}'">Back</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
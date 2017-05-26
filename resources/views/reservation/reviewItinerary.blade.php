@extends('layouts.app')

@section('head')
    Review Reservation
@endsection

@section('content')
    <div class="container" style="padding-top: 75px">
        <div class="row">
            <div class="col-sm-6 col-md-offset-3">
                <div class="panel panel-default">
                    <div class="panel-heading">View Reservation</div>

                    <div class="panel-body">
                        {!! Form::model($reservation, ['method'=>'POST', 'action'=> ['ReservationController@postReviewItinerary', $reservation->id], 'files' => true]) !!}
                        <div class="form-group{{ $errors->has('reservation_type_id') ? ' has-error' : '' }}" style="display: inline-block">
                            {!! Form::hidden('reservation_type_id', 1) !!}
                            {!! Form::label('reservation_type_id_label', 'Type of Reservation:  ') !!}
                            Tour Package
                        </div>
                        <div class="form-group">
                            {!! Form::label('user_name', 'User Name: ') !!}
                            {{$reservation->reserveUser->name}}<br>
                            {!! Form::label('user_email', 'Email: ') !!}
                            {{$reservation->reserveUser->email}}<br>
                            {!! Form::label('user_email', 'Phone Number: ') !!}
                            {{$reservation->reserveUser->phone_number}}
                        </div>
                        <div class="form-group{{ $errors->has('reservation_status_id') ? ' has-error' : '' }}" style="display: block">
                            {!! Form::label('reservation_status_label', 'Status') !!}
                            {!! Form::select('reservation_status_id', [''=>'Choose Options'] + $reservationStatusIds, $reservation->reserveStatus->id, ['id'=>'reservation_status_id', 'class'=>'form-control']) !!}
                            @if ($errors->has('reservation_status_id'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('reservation_status_id') }}</strong>
                                </span>
                            @endif
                        </div>
                        @php
                            $i = 1;
                        @endphp
                        <br>
                        @foreach($reservation->itineraries as $itinerary)
                            @if($itinerary->pivot->option == 1)
                                {!! Form::label('day_itinerary_label', 'Day ' . $itinerary->pivot->day) !!} ( {{$itinerary->option1_pickup_time}} -> {{$itinerary->option1_dropoff_time}} )<br>
                            @elseif($itinerary->pivot->option == 2)
                                {!! Form::label('day_itinerary_label', 'Day ' . $itinerary->pivot->day) !!} ( {{$itinerary->option2_pickup_time}} -> {{$itinerary->option2_dropoff_time}} )<br>
                            @endif
                            {!! Form::label('itinerary_label', 'Activity ' . $i) !!}
                            <div class="row form-group" id="itinerary-form">
                                <div class="col-sm-10">
                                    {!! Form::hidden('itinerary_id[]', $itinerary->id, ['multiple'=>'multiple']) !!}
                                    {!! Form::text('itinerary_name[]', $itinerary->name, ['class'=>'form-control', 'disabled']) !!}
                                </div>
                                <button type="button" class="btn btn-primary" onclick="location.href='{{route('itinerary.show', $itinerary->id)}}'">View</button>
                            </div>
                            @php
                                $i++;
                            @endphp
                        @endforeach
                        <div class="form-group{{ $errors->has('price_type') ? ' has-error' : '' }}" style="display: inline-block">
                            {!! Form::label('price_type_label', 'Price type:  ') !!}
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
                                    {!! Form::label('adult_no', 'Number of adult') !!}
                                    {!! Form::number('adult_no', $reservation->adult_no, ['class'=>'form-control', 'disabled']) !!}
                                    @if ($errors->has('adult_no'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('adult_no') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        @else
                            <div class="row">
                                <div id="adult_no" class="col-sm-6 form-group{{ $errors->has('adult_no') ? ' has-error' : '' }}">
                                    {!! Form::label('adult_no', 'Number of adult') !!}
                                    {!! Form::number('adult_no', $reservation->adult_no, ['class'=>'form-control', 'disabled']) !!}
                                    @if ($errors->has('adult_no'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('adult_no') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div id="children_no" class="col-sm-6 form-group{{ $errors->has('children_no') ? ' has-error' : '' }}">
                                    {!! Form::label('children_no', 'Number of children') !!}
                                    {!! Form::number('children_no', $reservation->children_no, ['class'=>'form-control', 'disabled']) !!}
                                    @if ($errors->has('children_no'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('children_no') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        @endif
                        <div class="row">
                            <div class="col-sm-6 form-group{{ $errors->has('reservation_start') ? ' has-error' : '' }}">
                                {!! Form::label('reservation_start', 'Start date') !!}
                                {!! Form::date('reservation_start', $reservation->reservation_start, ['class'=>'form-control', 'disabled']) !!}
                                @if ($errors->has('reservation_start'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('reservation_start') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-sm-6 form-group">
                                {!! Form::label('reservation_end', 'End date') !!}
                                {!! Form::date('reservation_end', $reservation->reservation_end, ['class'=>'form-control', 'disabled']) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            {!! Form::label('price', 'Price') !!}
                            {!! Form::text('price', currency($reservation->price, 'MYR', $currency['code']), ['class'=>'form-control', 'disabled']) !!}
                        </div>
                        @if($reservation->other_details != null)
                            <div class="form-group">
                                {!! Form::label('other_details_label', 'Other details from tourist: ') !!}
                                {!! Form::textarea('other_details', null, ['class'=>'form-control', 'rows'=>'4', 'disabled']) !!}
                            </div>
                        @endif
                        <div class="form-group{{ $errors->has('remarks') ? ' has-error' : '' }}">
                            {!! Form::label('remarks_label', 'Remark:') !!}
                            {!! Form::textarea('remarks', null, ['class'=>'form-control', 'rows'=>'4', 'placeholder'=>'Other details like flight ticket, no plat of car, etc.']) !!}
                            @if ($errors->has('remarks'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('remarks') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <br>
                            {!! Form::submit('Review Reservation', ['class'=>'btn btn-primary']) !!}
                            <button type="button" class="btn btn-primary" onclick="location.href='{{url()->previous()}}'">Cancel</button>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
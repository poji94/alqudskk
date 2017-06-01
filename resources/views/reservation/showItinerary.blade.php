@extends('layouts.backbone')

@section('head')
    View Reservation
@endsection

@section('style')
    body {
    background: url('/preset/backgroundViewReservationMoreDarken.jpg') no-repeat center center fixed;
    -webkit-background-size: cover;
    -moz-background-size: cover;
    -o-background-size: cover;
    background-size: cover;
    }
@endsection

@section('bodyClass')
    login-page
@endsection

@section('titlePage')
    <div class="wrapper">
        <div class="container col-md-6">
            <div class="content-center" style="margin-top: 75px;">
                <div class="card card-plain">
                    {{ csrf_field() }}
                    <div class="header header-primary text-center">
                        <h3 style="color: white;">Activity Reservation information.</h3>
                    </div>
                    <div class="form-group{{ $errors->has('reservation_type_id') ? ' has-error' : '' }}" style="display: inline-block">
                        {!! Form::hidden('reservation_type_id', 1) !!}
                        {!! Form::label('reservation_type_id_label', 'Type of Reservation:  ', ['style'=>'color: white;']) !!}
                        <p style="color: white; display: inline;">Activity</p>
                    </div>
                    <div class="content">>
                        <div class="form-group">
                            {!! Form::label('user_name', 'User Name: ', ['style'=>'color: white;']) !!} <p style="color: white; display: inline;">{{$reservation->reserveUser->name}}</p><br>
                            {!! Form::label('user_email', 'Email: ', ['style'=>'color: white;']) !!} <p style="color: white; display: inline;">{{$reservation->reserveUser->email}}</p><br>
                            {!! Form::label('user_phone_number', 'Phone Number: ', ['style'=>'color: white;']) !!}  <p style="color: white; display: inline">{{$reservation->reserveUser->phone_number}}</p>
                        </div>
                        <br>
                        <div class="form-group">
                            {!! Form::label('reservation_status_label', 'Status:  ', ['style'=>'color: white;']) !!}
                            <p style="color:white;">{{$reservation->reserveStatus->name}}</p>
                        </div>
                        <br>
                        <div>
                            {!! Form::label('itinerary_label', 'Itinerary', ['style'=>'color:white;']) !!}
                        </div>
                        @php
                            $i = 1;
                        @endphp
                        @foreach($reservation->itineraries as $itinerary)
                            @if($itinerary->pivot->option == 1)
                                <label for="day_itinerary_label" style="color: white;">Day {{$itinerary->pivot->day}} ( {{$itinerary->option1_pickup_time}} -> {{$itinerary->option1_dropoff_time}} )</label>
                            @elseif($itinerary->pivot->option == 2)
                                <label for="day_itinerary_label" style="color: white;">Day {{$itinerary->pivot->day}} ( {{$itinerary->option2_pickup_time}} -> {{$itinerary->option2_pickup_time}} )</label>
                            @endif
                            <br>
                            <div>
                                {!! Form::label('itinerary_id', 'Activity ' . $i . ': ', ['style'=>'color:white;']) !!}
                                <label for="itinerary_name" style="color: white; display: inline;">{{$itinerary->name}}</label>
                            </div>
                            @php
                                $i++;
                            @endphp
                        @endforeach
                        <br>
                        <div>
                            {!! Form::label('price_type', 'Price type: ', ['style'=>'color:white;']) !!}
                            @if($reservation->price_type == 'personal')
                                <p style="color: white; display: inline;">Personal</p>
                            @endif
                            @if($reservation->price_type == 'private_group')
                                <p style="color: white; display: inline;">Private Group</p>
                            @endif
                            @if($reservation->price_type == 'private_group')
                                <p style="color: white; display: inline;">Public Group</p>
                            @endif
                        </div>
                        <br>
                        @if($reservation->price_type == 'personal')
                            <div class="row">
                                <div id="adult_no" class="col-sm-6 input-group form-group-no-border input-lg">
                                    {!! Form::label('adult_no', 'Number of adult: ', ['style'=>'color:white;']) !!}
                                    <p style="color: white; display: inline;">{{$reservation->adult_no}}</p>
                                </div>
                            </div>
                        @else
                            <div class="row">
                                <div id="adult_no" class="col-sm-6 form-group">
                                    {!! Form::label('adult_no', 'Number of adult: ', ['style'=>'color:white;']) !!}
                                    <p style="color: white; display: inline;">{{$reservation->adult_no}}</p>f
                                </div>
                                <div id="children_no" class="col-sm-6 form-group">
                                    {!! Form::label('children_no', 'Number of children: ', ['style'=>'color:white;']) !!}
                                    <p style="color: white; display: inline;">{{$reservation->adult_child}}</p>
                                </div>
                            </div>
                        @endif
                        @if($reservation->reservation_status_id == 4)
                            @if($reservation->chosen_date == 1)
                                <br>
                                {!! Form::label('chosen_date_label', 'Chosen Date: Main', ['style'=>'color:white;']) !!}
                                <br>
                                <div class="row">
                                    <div class="col-sm-6 form-group form-group-no-border input-lg">
                                        <div>
                                            {!! Form::label('main_date', 'Start Date: ', ['style'=>'color:white;']) !!}
                                            <p style="color: white; display: inline;">{{$reservation->main_reservation_start}}</p>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 form-group form-group-no-border input-lg">
                                        <div>
                                            {!! Form::label('main_date_end', 'End Date: ', ['style'=>'color:white;']) !!}
                                            <p style="color: white; display: inline;">{{$reservation->main_reservation_end}}</p>
                                        </div>
                                    </div>
                                </div>
                            @elseif($reservation->chosen_date == 2)
                                <br>
                                {!! Form::label('chosen_date_label', 'Chosen Date: Alternative') !!}
                                <br>
                                <div class="row">
                                    <div class="col-sm-6 form-group form-group-no-border input-lg">
                                        <div>
                                            {!! Form::label('alternate_main_date', 'Start Date: ', ['style'=>'color:white;']) !!}
                                            <p style="color: white; display: inline;">{{$reservation->alternate_reservation_start}}</p>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 form-group form-group-no-border input-lg">
                                        <div>
                                            {!! Form::label('alternate_date_end', 'End Date: ', ['style'=>'color:white;']) !!}
                                            <p style="color: white; display: inline;">{{$reservation->alternate_reservation_end}}</p>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @else
                            <div class="row">
                                <div class="col-sm-6 form-group form-group-no-border input-lg">
                                    <div>
                                        {!! Form::label('main_date', 'Main Reservation Start Date: ', ['style'=>'color:white;']) !!}
                                        <br>
                                        <p style="color: white; display: inline;">{{$reservation->main_reservation_start}}</p>
                                    </div>
                                </div>
                                <div class="col-sm-6 form-group form-group-no-border input-lg">
                                    <div>
                                        {!! Form::label('main_date_end', 'Main Reservation End Date: ', ['style'=>'color:white;']) !!}
                                        <br>
                                        <p style="color: white; display: inline;">{{$reservation->main_reservation_end}}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6 form-group form-group-no-border input-lg">
                                    <div>
                                        {!! Form::label('alternate_main_date', 'Alternative Reservation Start Date: ', ['style'=>'color:white;']) !!}
                                        <br>
                                        <p style="color: white; display: inline;">{{$reservation->alternate_reservation_start}}</p>
                                    </div>
                                </div>
                                <div class="col-sm-6 form-group form-group-no-border input-lg">
                                    <div>
                                        {!! Form::label('alternate_date_end', 'Alternative Reservation End Date: ', ['style'=>'color:white;']) !!}
                                        <br>
                                        <p style="color: white; display: inline;">{{$reservation->alternate_reservation_end}}</p>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <br>
                        <div class="form-group form-group-no-border">
                            {!! Form::label('price', 'Price: ', ['style'=>'color:white;']) !!}
                            <p style="color: white; display: inline;">{{$reservation->price}}</p>
                        </div>
                        <br>
                        @if($reservation->other_details)
                            <div class="form-group-no-border input-lg">
                                {!! Form::label('other_details', 'Other Details from tourist: ', ['style'=>'color:white;']) !!}
                                <p style="color: white;">{{$reservation->other_details}}</p>
                            </div>
                        @endif
                        <br>
                        @if($reservation->remarks)
                            <div>
                                {!! Form::label('remarks', 'Remarks: ', ['style'=>'color:white;']) !!}
                            </div>
                            <div class="input-group form-group-no-border input-lg{{ $errors->has('remarks') ? ' has-error' : '' }}">
                                <p style="color: white;">{{$reservation->remarks}}</p>
                            </div>
                        @endif
                        <div class="footer text-center">
                            @if(Auth::user()->role_user_id == 3)
                                <button type="button" class="col-sm-6 btn btn-primary btn-round" onclick="location.href='{{route('reservation.getUserReservation')}}'">Back</button>
                            @else
                                <button type="button" class="col-sm-6 btn btn-primary btn-round" onclick="location.href='{{route('reservation.index')}}'">Back</button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
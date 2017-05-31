@extends('layouts.backbone')

@section('head')
    Review Reservation
@endsection

@section('style')
    body {
    background: url('/preset/backgroundDarken.jpg') no-repeat center center fixed;
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
                    <form class="form" method="POST" action="{{url('reservation/reviewItinerary/' . $reservation->id)}}">
                        {{ csrf_field() }}
                        <div class="header header-primary text-center">
                            <h3 style="color: white;">Please review booking activity information.</h3>
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
                                    {!! Form::label('itinerary_id', 'Activity ' . $i, ['style'=>'color:white;']) !!}
                                </div>
                                <div class="row form-group form-group-no-border" id="itinerary-form{{$i}}">
                                    <div class="col-sm-9">
                                        <input name="itinerary_id[]" id="itinerary_id" type="hidden" mutltiple="multiple" value="{{$itinerary->id}}">
                                        <input class="form-control" disabled="disabled" mutltiple="multiple" name="itinerary_name[]" type="text" value="{{$itinerary->name}}" style="color: white;">
                                    </div>
                                    <button type="button" class="btn btn-primary btn-round" onclick="location.href='{{route('itinerary.show', $itinerary->id)}}'">View</button>
                                </div>
                                @php
                                    $i++;
                                @endphp
                            @endforeach
                            <div>
                                {!! Form::label('price_type', 'Choose price type', ['style'=>'color:white;']) !!}
                                @if($reservation->price_type == 'personal')
                                    <p style="color: white; display: inline;">Personal</p>
                                @endif
                                @if($reservation->price_type == 'private_group')
                                    <p style="color: white; display: inline;">Private Group</p>
                                @endif
                                @if($reservation->price_type == 'private_group')
                                    <p style="color: white; display: inline;">Public Group</p>
                                @endif
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#adult_no").hide();
                                        $("#children_no").hide();
                                        if(document.getElementById('personal').checked) {
                                            $("#adult_no").slideUp();
                                            $("#children_no").slideUp();
                                        }
                                        else if(document.getElementById('private_group').checked) {
                                            $("#adult_no").slideDown();
                                            $("#children_no").slideDown();
                                        }
                                        else if(document.getElementById('public_group').checked) {
                                            $("#adult_no").slideDown();
                                            $("#children_no").slideDown();
                                        }
                                        $("#personal").click(function(){
                                            $("#adult_no").slideUp();
                                            $("#children_no").slideUp();
                                        });
                                        $("#private_group").click(function(){
                                            $("#adult_no").slideDown();
                                            $("#children_no").slideDown();
                                        });
                                        $("#public_group").click(function(){
                                            $("#adult_no").slideDown();
                                            $("#children_no").slideDown();
                                        });
                                    });
                                </script>
                            </div>
                            @if($reservation->price_type == 'personal')
                                <div class="row">
                                    <div id="adult_no" class="col-sm-6 input-group form-group-no-border input-lg{{ $errors->has('adult_no') ? ' has-error' : '' }}">
                                        {!! Form::number('adult_no', $reservation->adult_no, ['class'=>'form-control', 'disabled']) !!}
                                        @if ($errors->has('adult_no'))
                                            <span class="form-control form-control-danger" style="color: white;">
                                                <strong>{{ $errors->first('adult_no') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            @else
                                <div class="row">
                                    <div id="adult_no" class="col-sm-6 form-group{{ $errors->has('adult_no') ? ' has-error' : '' }}">
                                        {!! Form::number('adult_no', $reservation->adult_no, ['class'=>'form-control', 'disabled']) !!}
                                        @if ($errors->has('adult_no'))
                                            <span class="form-control form-control-danger" style="color: white;">
                                                <strong>{{ $errors->first('adult_no') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div id="children_no" class="col-sm-6 form-group{{ $errors->has('children_no') ? ' has-error' : '' }}">
                                        {!! Form::number('children_no', $reservation->children_no, ['class'=>'form-control', 'disabled']) !!}
                                        @if ($errors->has('children_no'))
                                            <span class="form-control form-control-danger" style="color: white;">
                                                <strong>{{ $errors->first('children_no') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            @endif
                            <div class="row">
                                <div class="col-sm-6 form-group form-group-no-border input-lg{{ $errors->has('main_reservation_start') ? ' has-error' : '' }}">
                                    <div>
                                        {!! Form::label('main_date', 'Main Reservation Start Date', ['style'=>'color:white;']) !!}
                                    </div>
                                    {!! Form::date('main_reservation_start', $reservation->main_reservation_start, ['class'=>'form-control', 'min'=>\Carbon\Carbon::today()->toDateString(), 'disabled', 'onkeydown'=>'return false', 'style'=>'color:white;']) !!}
                                    @if ($errors->has('main_reservation_start'))
                                        <span class="form-control form-control-danger" style="color: white;">
                                            {{ $errors->first('main_reservation_start') }}
                                        </span>
                                    @endif
                                </div>
                                <div class="col-sm-6 form-group form-group-no-border input-lg{{ $errors->has('main_reservation_end') ? ' has-error' : '' }}">
                                    <div>
                                        {!! Form::label('main_date_end', 'Main Reservation End Date', ['style'=>'color:white;']) !!}
                                    </div>
                                    {!! Form::date('main_reservation_start', $reservation->main_reservation_end, ['class'=>'form-control', 'min'=>\Carbon\Carbon::today()->toDateString(), 'disabled','onkeydown'=>'return false', 'style'=>'color:white;']) !!}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6 form-group form-group-no-border input-lg{{ $errors->has('alternate_reservation_start') ? ' has-error' : '' }}">
                                    <div>
                                        {!! Form::label('alternate_date', 'Alternative Reservation Start Date', ['style'=>'color:white;']) !!}
                                    </div>
                                    {!! Form::date('alternate_reservation_start', $reservation->alternate_reservation_start, ['class'=>'form-control', 'min'=>\Carbon\Carbon::today()->toDateString(), 'disabled', 'onkeydown'=>'return false', 'style'=>'color:white;']) !!}
                                    @if ($errors->has('alternate_reservation_start'))
                                        <span class="form-control form-control-danger" style="color: white;">
                                            {{ $errors->first('alternate_reservation_start') }}
                                        </span>
                                    @endif
                                </div>
                                <div class="col-sm-6 form-group form-group-no-border input-lg{{ $errors->has('alternate_reservation_end') ? ' has-error' : '' }}">
                                    <div>
                                        {!! Form::label('alternate_date_end', 'Alternate Reservation End Date', ['style'=>'color:white;']) !!}
                                    </div>
                                    {!! Form::date('alternate_reservation_end', $reservation->alternate_reservation_end, ['class'=>'form-control', 'min'=>\Carbon\Carbon::today()->toDateString(), 'disabled','onkeydown'=>'return false', 'style'=>'color:white;']) !!}
                                </div>
                            </div>
                            <div>
                                {!! Form::label('price', 'Price', ['style'=>'color:white;']) !!}
                            </div>
                            <div class="form-group form-group-no-border">
                                {!! Form::text('price', currency($reservation->price, 'MYR', $currency['code']), ['class'=>'form-control', 'disabled', 'style'=>'color:white;']) !!}
                            </div>
                            <div class="form-group form-group-no-border{{ $errors->has('reservation_status_id') ? ' has-error' : '' }}" style="display: block">
                                {!! Form::label('reservation_status_label', 'Status', ['style'=>'color: white;']) !!}
                                {!! Form::select('reservation_status_id', [''=>'Choose Options'] + $reservationStatusIds, $reservation->reserveStatus->id, ['id'=>'reservation_status_id', 'class'=>'form-control', 'style'=>'color:white;']) !!}
                                <style>
                                    option {
                                        color: black;
                                    }
                                    option:disabled {
                                        color: grey;
                                    }
                                </style>
                                @if ($errors->has('reservation_status_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('reservation_status_id') }}</strong>
                                    </span>
                                @endif
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#chosen_date").hide();
                                        $("#reservation_status_id option[value='1']").attr("disabled", true);
                                        $("#reservation_status_id option[value='2']").attr("disabled", true);

                                        if($("#reservation_status_id").val() == 4) {
                                            $("#chosen_date").slideDown();
                                        }

                                        $("#reservation_status_id").change(function() {
                                            var value = $(this).find('option:selected').attr('value');
                                            if(value == 4) {
                                                $("#chosen_date").slideDown();
                                            }
                                            else {
                                                $("#chosen_date").slideUp();
                                            }
                                        });
                                    });
                                </script>
                            </div>
                            <div id="chosen_date" class="form-group form-group-no-border{{ $errors->has('chosen_date') ? ' has-error' : ''}}">
                                <div>
                                    {!! Form::label('chosen_date_label', 'Choose date: ', ['style'=>'color:white;']) !!}
                                </div>
                                {!! Form::select('chosen_date', ['1'=>'Main date', '2'=>'Alternate date'], $reservation->chosen_date, ['id'=>'chosen_date_dropdown', 'class'=>'form-control', 'style'=>'color:white;']) !!}
                                <style>
                                    option {
                                        color: black;
                                    }
                                </style>
                            </div>
                            @if($reservation->other_details)
                                <div>
                                    {!! Form::label('other_details', 'Other Details: ', ['style'=>'color:white;']) !!}
                                </div>
                                <div class="input-group form-group-no-border input-lg{{ $errors->has('other_details') ? ' has-error' : '' }}">
                                    <textarea id="other_details" name="other_details" type="text" class="form-control" rows="4" placeholder="Other details for the reservation" style="color: white">{{$reservation->other_details}}</textarea>
                                </div>
                            @endif
                            <div>
                                {!! Form::label('remarks', 'Remarks: ', ['style'=>'color:white;']) !!}
                            </div>
                            <div class="input-group form-group-no-border input-lg{{ $errors->has('remarks') ? ' has-error' : '' }}">
                                <textarea id="remarks" name="remarks" type="text" class="form-control" rows="4" placeholder="Other details like flight ticket, no plat of car, etc." style="color: white">{{$reservation->remarks}}</textarea>
                                @if ($errors->has('remarks'))
                                    <span class="form-control form-control-danger" style="color: white;">
                                        {{ $errors->first('remarks') }}
                                    </span>
                                @endif
                            </div>
                            <div class="row footer text-center">
                                <button type="submit" class="col-sm-6 btn btn-primary btn-round btn-lg btn-block">Review Reservation</button>
                                <button type="button" class="col-sm-6 btn btn-warning btn-round" onclick="location.href='{{url()->previous()}}'">Cancel</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
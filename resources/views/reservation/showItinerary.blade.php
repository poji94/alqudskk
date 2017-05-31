@extends('layouts.backbone')

@section('head')
    View Reservation
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
                                {!! Form::label('chosen_date_label', 'Chosen Date: Main', ['style'=>'color:white;']) !!}
                                <br>
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
                                {!! Form::label('chosen_date_label', 'Chosen Date: Alternative') !!}
                                <br>
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
                                <div class="row">
                                    <div class="col-sm-6 form-group form-group-no-border input-lg">
                                        <div>
                                            {!! Form::label('main_date', 'Main Reservation Start Date: ', ['style'=>'color:white;']) !!}
                                            <p style="color: white; display: inline;">{{$reservation->main_reservation_start}}</p>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 form-group form-group-no-border input-lg">
                                        <div>
                                            {!! Form::label('main_date_end', 'Main Reservation End Date: ', ['style'=>'color:white;']) !!}
                                            <p style="color: white; display: inline;">{{$reservation->main_reservation_end}}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6 form-group form-group-no-border input-lg">
                                    <div>
                                        {!! Form::label('alternate_main_date', 'Alternative Reservation Start Date: ', ['style'=>'color:white;']) !!}
                                        <p style="color: white; display: inline;">{{$reservation->alternate_reservation_start}}</p>
                                    </div>
                                </div>
                                <div class="col-sm-6 form-group form-group-no-border input-lg">
                                    <div>
                                        {!! Form::label('alternate_date_end', 'Alternative Reservation End Date: ', ['style'=>'color:white;']) !!}
                                        <p style="color: white; display: inline;">{{$reservation->alternate_reservation_end}}</p>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <div class="form-group form-group-no-border">
                            {!! Form::label('price', 'Price: ', ['style'=>'color:white;']) !!}
                            <p style="color: white; display: inline;">{{$reservation->price}}</p>
                        </div>
                        @if($reservation->other_details)
                            <div class="form-group-no-border input-lg">
                                {!! Form::label('other_details', 'Other Details from tourist: ', ['style'=>'color:white;']) !!}
                                <p style="color: white;">{{$reservation->other_details}}</p>
                            </div>
                        @endif
                        <div class="form-group-no-border input-lg">
                            {!! Form::label('Remarks', 'Remarks from Reviewer: ', ['style'=>'color:white;']) !!}
                            <p style="color: white;">{{$reservation->remarks}}</p>
                        </div>
                        <div class="form-group">
                            <br>
                            <div>
                                {!! Form::label('review_label', 'Reviewed By: ', ['style'=>'color:white;']) !!}
                            </div>
                            {!! Form::label('reviewer_name', 'User Name: ', ['style'=>'color: white;']) !!} <p style="color: white; display: inline;">{{$reservation->reserveUser->name}}</p><br>
                            {!! Form::label('reviewer_email', 'Email: ', ['style'=>'color: white;']) !!} <p style="color: white; display: inline;">{{$reservation->reserveUser->email}}</p><br>
                            {!! Form::label('reviewer_phone_number', 'Phone Number: ', ['style'=>'color: white;']) !!}  <p style="color: white; display: inline">{{$reservation->reserveUser->phone_number}}</p>
                        </div>
                        <div class="footer text-center">
                            <button type="button" class="col-sm-6 btn btn-primary btn-round" onclick="location.href='{{url()->previous()}}'">Back</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    {{--<div class="container" style="padding-top: 75px">--}}
        {{--<div class="row">--}}
            {{--<div class="col-sm-6 col-md-offset-3">--}}
                {{--<div class="panel panel-default">--}}
                    {{--<div class="panel-heading">View Reservation</div>--}}

                    {{--<div class="panel-body">--}}
                        {{--<div class="form-group{{ $errors->has('reservation_type_id') ? ' has-error' : '' }}" style="display: inline-block">--}}
                            {{--{!! Form::hidden('reservation_type_id', 2) !!}--}}
                            {{--{!! Form::label('reservation_type_id_label', 'Type of Reservation:  ') !!}--}}
                            {{--Tour package--}}
                        {{--</div>--}}
                        {{--<div class="form-group">--}}
                            {{--{!! Form::label('user_name', 'User Name: ') !!}--}}
                            {{--{{$reservation->reserveUser->name}}<br>--}}
                            {{--{!! Form::label('user_email', 'Email: ') !!}--}}
                            {{--{{$reservation->reserveUser->email}}<br>--}}
                            {{--{!! Form::label('user_email', 'Phone Number: ') !!}--}}
                            {{--{{$reservation->reserveUser->phone_number}}--}}
                        {{--</div>--}}
                        {{--<div class="form-group">--}}
                            {{--{!! Form::label('reservation_status_label', 'Status:  ') !!}--}}
                            {{--{{$reservation->reserveStatus->name}}--}}
                        {{--</div>--}}
                        {{--@php--}}
                            {{--$i = 1;--}}
                        {{--@endphp--}}
                        {{--<br>--}}
                        {{--{!! Form::label('itinerary_label', 'Itinerary') !!}<br>--}}
                        {{--@foreach($reservation->itineraries as $itinerary)--}}
                            {{--@if($itinerary->pivot->option == 1)--}}
                                {{--{!! Form::label('day_itinerary_label', 'Day ' . $itinerary->pivot->day) !!} ( {{$itinerary->option1_pickup_time}} -> {{$itinerary->option1_dropoff_time}} )<br>--}}
                            {{--@elseif($itinerary->pivot->option == 2)--}}
                                {{--{!! Form::label('day_itinerary_label', 'Day ' . $itinerary->pivot->day) !!} ( {{$itinerary->option2_pickup_time}} -> {{$itinerary->option2_dropoff_time}} )<br>--}}
                            {{--@endif--}}
                            {{--{!! Form::label('itinerary_label', 'Activity ' . $i . ': ') !!}--}}
                            {{--{{$itinerary->name}}--}}
                            {{--<br><br>--}}
                            {{--@php--}}
                                {{--$i++;--}}
                            {{--@endphp--}}
                        {{--@endforeach--}}
                        {{--<div class="form-group{{ $errors->has('price_type') ? ' has-error' : '' }}" style="display: inline-block">--}}
                            {{--{!! Form::label('price_type_label', 'Type: ') !!}--}}
                            {{--@if($reservation->price_type == 'personal')--}}
                                {{--Personal--}}
                            {{--@elseif($reservation->price_type == 'private_group')--}}
                                {{--Private Group--}}
                            {{--@elseif($reservation->price_type == 'public_group')--}}
                                {{--Public Group--}}
                            {{--@endif--}}
                        {{--</div>--}}
                        {{--@if($reservation->price_type == 'personal')--}}
                            {{--<div class="row">--}}
                                {{--<div id="adult_no" class="col-sm-6 form-group{{ $errors->has('adult_no') ? ' has-error' : '' }}">--}}
                                    {{--{!! Form::label('adult_no', 'Number of adult: ') !!}--}}
                                    {{--{{$reservation->adult_no}}--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--@else--}}
                            {{--<div class="row">--}}
                                {{--<div id="adult_no" class="col-sm-6 form-group{{ $errors->has('adult_no') ? ' has-error' : '' }}">--}}
                                    {{--{!! Form::label('adult_no', 'Number of adult: ') !!}--}}
                                    {{--{{$reservation->adult_no}}--}}
                                {{--</div>--}}
                                {{--<div id="children_no" class="col-sm-6 form-group{{ $errors->has('children_no') ? ' has-error' : '' }}">--}}
                                    {{--{!! Form::label('children_no', 'Number of children: ') !!}--}}
                                    {{--{{$reservation->children_no}}--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--@endif--}}
                        {{--@if($reservation->reservation_status_id == 4)--}}
                            {{--@if($reservation->chosen_date == 1)--}}
                            {{--{!! Form::label('chosen_date_label', 'Chosen Date: Main') !!}--}}
                            {{--<div class="row">--}}
                                {{--<div class="col-sm-6 form-group{{ $errors->has('reservation_start') ? ' has-error' : '' }}">--}}
                                    {{--{!! Form::label('reservation_start', 'Start date: ') !!}--}}
                                    {{--{{$reservation->main_reservation_start}}--}}
                                {{--</div>--}}
                                {{--<div class="col-sm-6 form-group">--}}
                                    {{--{!! Form::label('reservation_end', 'End date: ') !!}--}}
                                    {{--{{$reservation->main_reservation_end}}--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            {{--@elseif($reservation->chosen_date == 2)--}}
                            {{--{!! Form::label('chosen_date_label', 'Chosen Date: Alternative') !!}--}}
                            {{--<div class="row">--}}
                                {{--<div class="col-sm-6 form-group{{ $errors->has('reservation_start') ? ' has-error' : '' }}">--}}
                                    {{--{!! Form::label('reservation_start', 'Start date: ') !!}--}}
                                    {{--{{$reservation->alternate_reservation_start}}--}}
                                {{--</div>--}}
                                {{--<div class="col-sm-6 form-group">--}}
                                    {{--{!! Form::label('reservation_end', 'End date: ') !!}--}}
                                    {{--{{$reservation->alternate_reservation_end}}--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            {{--@endif--}}
                        {{--@else--}}
                            {{--<div class="row">--}}
                                {{--<div class="col-sm-6 form-group{{ $errors->has('reservation_start') ? ' has-error' : '' }}">--}}
                                    {{--{!! Form::label('reservation_start', 'Main Start date: ') !!}--}}
                                    {{--{{$reservation->main_reservation_start}}--}}
                                {{--</div>--}}
                                {{--<div class="col-sm-6 form-group">--}}
                                    {{--{!! Form::label('reservation_end', 'Main End date: ') !!}--}}
                                    {{--{{$reservation->main_reservation_end}}--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            {{--<div class="row">--}}
                                {{--<div class="col-sm-6 form-group{{ $errors->has('reservation_start') ? ' has-error' : '' }}">--}}
                                    {{--{!! Form::label('reservation_start', 'Alternative Start date: ') !!}--}}
                                    {{--{{$reservation->alternate_reservation_start}}--}}
                                {{--</div>--}}
                                {{--<div class="col-sm-6 form-group">--}}
                                    {{--{!! Form::label('reservation_end', 'Alternative End date: ') !!}--}}
                                    {{--{{$reservation->alternate_reservation_end}}--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--@endif--}}
                        {{--<div class="form-group">--}}
                            {{--{!! Form::label('price', 'Price: ') !!}--}}
                            {{--{{currency($reservation->price, currency()->config('default'), $currency['code'])}}--}}
                        {{--</div>--}}
                        {{--@if($reservation->other_details != null)--}}
                            {{--<div class="from-group">--}}
                                {{--{!! Form::label('other_details_label', 'Other details from user: ') !!}<br>--}}
                                {{--{{ $reservation->other_details }}<br><br>--}}
                            {{--</div>--}}
                        {{--@endif--}}
                        {{--@if($reservation->reserveStatus->id != 2)--}}
                            {{--<div class="form-group">--}}
                                {{--{!! Form::label('remarks_label', 'Remark: ') !!}<br>--}}
                                {{--{{ $reservation->remarks }}<br>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--{!! Form::label('reviewer_name', 'More info, please enquire: ') !!}<br>--}}
                                {{--{{$remarksBy->name}}<br>--}}
                                {{--{!! Form::label('user_email', 'Email: ') !!}--}}
                                {{--{{$remarksBy->email}}<br>--}}
                                {{--{!! Form::label('user_email', 'Phone Number: ') !!}--}}
                                {{--{{$remarksBy->phone_number}}--}}
                            {{--</div>--}}
                        {{--@endif--}}
                        {{--<div class="form-group">--}}
                            {{--<button type="button" class="btn btn-primary" onclick="location.href='{{url()->previous()}}'">Back</button>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
@endsection
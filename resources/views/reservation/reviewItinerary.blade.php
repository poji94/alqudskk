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
                            <div class="col-sm-6 form-group">
                                {!! Form::label('main_reservation_start_label', 'Start date') !!}
                                {!! Form::date('main_reservation_start', null, ['class'=>'form-control', 'disabled']) !!}
                            </div>
                            <div class="col-sm-6 form-group">
                                {!! Form::label('main_reservation_end_label', 'End date') !!}
                                {!! Form::date('main_reservation_end', $reservation->main_reservation_end, ['class'=>'form-control', 'disabled']) !!}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6 form-group">
                                {!! Form::label('alternate_reservation_start_label', 'Alternative start date') !!}
                                {!! Form::date('alternate_reservation_start', null, ['class'=>'form-control', 'disabled']) !!}
                            </div>
                            <div class="col-sm-6 form-group">
                                {!! Form::label('alternate_reservation_end', 'Alternative end date') !!}
                                {!! Form::date('alternate_reservation_end', $reservation->alternate_reservation_end, ['class'=>'form-control', 'disabled']) !!}
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
                        <div id="chosen_date" class="form-group{{ $errors->has('chosen_date') ? ' has-error' : ''}}">
                            {!! Form::label('chosen_date_label', 'Choose date: ') !!}
                            {!! Form::select('chosen_date', ['1'=>'Main date', '2'=>'Alternate date'], $reservation->chosen_date, ['id'=>'chosen_date_dropdown', 'class'=>'form-control']) !!}
                        </div>
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
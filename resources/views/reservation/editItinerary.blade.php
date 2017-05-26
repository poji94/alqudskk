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
                        {!! Form::model($reservation, ['method'=>'POST', 'action'=> ['ReservationController@updateItinerary', $reservation->id], 'files' => true]) !!}
                        <div class="form-group{{ $errors->has('reservation_type_id') ? ' has-error' : '' }}" style="display: inline-block">
                            {!! Form::hidden('reservation_type_id', 1) !!}
                            {!! Form::label('reservation_type_id_label', 'Type of Reservation:  ') !!}
                            Activity

                        </div>
                        @php
                            $i = 1;
                        @endphp
                        <br>
                        {!! Form::label('itinerary_label', 'Itinerary') !!}<br>
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
                            {!! Form::label('price_type_label', 'Please choose:  ') !!}
                            @if($reservation->reserveStatus->id == 1)
                                @if($reservation->price_type == 'personal')
                                    <label class="radio-inline">
                                        {!! Form::radio('price_type', 'personal', true, ['id'=>'personal', 'style'=>'display:inline-block']) !!}
                                        Personal
                                    </label>
                                @else
                                    <label class="radio-inline">
                                        {!! Form::radio('price_type', 'personal', false, ['id'=>'personal', 'style'=>'display:inline-block']) !!}
                                        Personal
                                    </label>
                                @endif
                                @if($reservation->price_type == 'private_group')
                                    <label class="radio-inline">
                                        {!! Form::radio('price_type', 'private_group', true, ['id'=>'private_group', 'style'=>'display:inline-block']) !!}
                                        Private Group
                                    </label>
                                @else
                                    <label class="radio-inline">
                                        {!! Form::radio('price_type', 'private_group', false, ['id'=>'private_group', 'style'=>'display:inline-block']) !!}
                                        Private Group
                                    </label>
                                @endif
                                @if($reservation->price_type == 'public_group')
                                    <label class="radio-inline">
                                        {!! Form::radio('price_type', 'public_group', true, ['id'=>'public_group', 'style'=>'display:inline-block']) !!}
                                        Public Group
                                    </label>
                                @else
                                    <label class="radio-inline">
                                        {!! Form::radio('price_type', 'public_group', false, ['id'=>'public_group', 'style'=>'display:inline-block']) !!}
                                        Public Group
                                    </label>
                                @endif
                            @endif
                            @if ($errors->has('price_type'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('price_type') }}</strong>
                                    </span>
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
                        <div class="row">
                            <div id="adult_no" class="col-sm-6 form-group{{ $errors->has('adult_no') ? ' has-error' : '' }}">
                                {!! Form::label('adult_no', 'Number of adult') !!}
                                {!! Form::number('adult_no', $reservation->adult_no, ['class'=>'form-control', 'id'=>'adult_no']) !!}
                                @if ($errors->has('adult_no'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('adult_no') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div id="children_no" class="col-sm-6 form-group{{ $errors->has('children_no') ? ' has-error' : '' }}">
                                {!! Form::label('children_no', 'Number of children') !!}
                                {!! Form::number('children_no', $reservation->children_no, ['class'=>'form-control', 'id'=>'children_no']) !!}
                                @if ($errors->has('children_no'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('children_no') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6 form-group{{ $errors->has('reservation_start') ? ' has-error' : '' }}">
                                {!! Form::label('reservation_start', 'Start date') !!}
                                {!! Form::date('reservation_start', $reservation->reservation_start, ['class'=>'form-control', 'min'=>\Carbon\Carbon::today()->toDateString(), 'onkeydown'=>'return false']) !!}
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
                        <div class="form-group{{ $errors->has('other_details') ? ' has-error' : '' }}">
                            {!! Form::label('other_details_label', 'Other details:') !!}
                            {!! Form::textarea('other_details', null, ['class'=>'form-control', 'rows'=>'4', 'placeholder'=>'Any information regarding the reserved activities']) !!}
                            @if ($errors->has('other_details'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('other_details') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            {!! Form::submit('Edit Reservation', ['class'=>'btn btn-primary']) !!}
                            <button type="button" class="btn btn-primary" onclick="location.href='{{url()->previous()}}'">Cancel</button>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
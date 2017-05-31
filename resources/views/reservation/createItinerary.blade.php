@extends('layouts.backbone')

@section('head')
    Create Reservation
@endsection

@section('style')
    body {
        background: url('/preset/backgroundReservationMoreDarken.jpg') no-repeat center center fixed;
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
                    <form class="form" method="POST" action="{{url('reservation/storedItinerary')}}">
                        {{ csrf_field() }}
                        <div class="header header-primary text-center">
                            <h3 style="color: white;">Please insert new booking activity information.</h3>
                        </div>
                        <div class="form-group{{ $errors->has('reservation_type_id') ? ' has-error' : '' }}" style="display: inline-block">
                            {!! Form::hidden('reservation_type_id', 1) !!}
                            {!! Form::label('reservation_type_id_label', 'Type of Reservation:  ', ['style'=>'color: white;']) !!}
                            <p style="color: white; display: inline;">Activity</p>
                        </div>
                        <div class="content">
                            <div>
                                {!! Form::label('itinerary_label', 'Itinerary', ['style'=>'color:white;']) !!}
                            </div>
                            @if($errors->has('itinerary_id'))
                                <div class="badge badge-danger">
                                    <ul>
                                        <strong>{{ $errors->first('itinerary_id') }}</strong>
                                    </ul>
                                </div>
                            @endif
                            @php
                                $i = 1;
                            @endphp
                            @if($reservedItineraries && $reservedItinerariesOption)
                                @foreach($reservedItineraries as $reservedItinerary)
                                    @if($reservedItinerariesOption[$i] == 1)
                                        <label for="day_itinerary_label" style="color: white;">Day {{$reservedDayItineraries[$i]}} ( {{$reservedItinerary['option1_pickup_time']}} -> {{$reservedItinerary['option1_dropoff_time']}} )</label>
                                    @elseif($reservedItinerariesOption[$i] == 2)
                                        <label for="day_itinerary_label" style="color: white;">Day {{$reservedDayItineraries[$i]}} ( {{$reservedItinerary['option2_pickup_time']}} -> {{$reservedItinerary['option2_dropoff_time']}} )</label>
                                    @endif
                                    <br>
                                    <div>
                                        {!! Form::label('itinerary_id', 'Activity ' . $i, ['style'=>'color:white;']) !!}
                                    </div>
                                    <div class="row form-group form-group-no-border" id="itinerary-form{{$i}}">
                                        <div class="col-sm-8">
                                            <input name="itinerary_id[]" id="itinerary_id" type="hidden" mutltiple="multiple" value="{{$reservedItinerary['id']}}">
                                            <input class="form-control" disabled="disabled" mutltiple="multiple" name="itinerary_name[]" type="text" value="{{$reservedItinerary['name']}}" style="color: white;">
                                        </div>
                                        <button type="button" class="btn btn-primary btn-round" onclick="location.href='{{route('itinerary.show', $reservedItinerary['id'])}}'">View</button>
                                        <button type="button" class="btn btn-danger btn-round" onclick="location.href='{{route('reservation.removeItineraryFromSession', $i)}}'">Remove</button>
                                    </div>
                                    @php
                                        $i++;
                                    @endphp
                                @endforeach
                            @endif
                            <div class="form-group">
                                <button type="button" class="btn btn-primary btn-round" onclick="location.href='{{route('itinerary.getSelection')}}'">Add Activity</button>
                            </div>
                            <div>
                                {!! Form::label('price_type', 'Choose price type', ['style'=>'color:white;']) !!}
                            </div>
                            <div class="radio radio-primary">
                                <input type="radio" name="price_type" id="personal" value="personal">
                                <label for="personal">
                                    <p style="color: white">Personal     </p>
                                </label>
                                <input type="radio" name="price_type" id="private_group" value="private_group">
                                <label for="private_group">
                                    <p style="color: white">Private Group     </p>
                                </label>
                                <input type="radio" name="price_type" id="public_group" value="public_group">
                                <label for="public_group">
                                    <p style="color: white">Public Group</p>
                                </label>
                                @if ($errors->has('price_type'))
                                    <span class="badge badge-danger">
                                        <strong>{{ $errors->first('price_type') }}</strong>
                                    </span>
                                @endif
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#adult_no").hide();
                                        $("#children_no").hide();
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
                                <div class="col-sm-6 input-group form-group-no-border input-lg{{ $errors->has('adult_no') ? ' has-error' : '' }}">
                                    <input id="adult_no" name="adult_no" type="number" class="form-control" placeholder="Number of Adult" value="1" style="color: white">
                                    @if ($errors->has('adult_no'))
                                        <span class="badge badge-danger">
                                            {{ $errors->first('adult_no') }}
                                        </span>
                                    @endif
                                </div>
                                <div class="col-sm-6 input-group form-group-no-border input-lg{{ $errors->has('children_no') ? ' has-error' : '' }}">
                                    <input id="children_no" name="children_no" type="number" class="form-control" placeholder="Number of Children" value="0" style="color: white">
                                    @if ($errors->has('children_no'))
                                        <span class="badge badge-danger">
                                            {{ $errors->first('children_no') }}
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6 form-group form-group-no-border input-lg{{ $errors->has('main_reservation_start') ? ' has-error' : '' }}">
                                    <div>
                                        {!! Form::label('main_date', 'Main Reservation Start Date', ['style'=>'color:white;']) !!}
                                    </div>
                                    {!! Form::date('main_reservation_start', null, ['class'=>'form-control', 'min'=>\Carbon\Carbon::today()->toDateString(), 'onkeydown'=>'return false', 'style'=>'color:white;']) !!}
                                    @if ($errors->has('main_reservation_start'))
                                        <span class="badge badge-danger">
                                            {{ $errors->first('main_reservation_start') }}
                                        </span>
                                    @endif
                                </div>
                                <div class="col-sm-6 form-group form-group-no-border input-lg{{ $errors->has('alternate_reservation_start') ? ' has-error' : '' }}">
                                    <div>
                                        {!! Form::label('alternate_date', 'Alternative Reservation Start Date', ['style'=>'color:white;']) !!}
                                    </div>
                                    {!! Form::date('alternate_reservation_start', null, ['class'=>'form-control', 'min'=>\Carbon\Carbon::today()->toDateString(), 'onkeydown'=>'return false', 'style'=>'color:white;']) !!}
                                    @if ($errors->has('alternate_reservation_start'))
                                        <span class="badge badge-danger">
                                            {{ $errors->first('alternate_reservation_start') }}
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div>
                                {!! Form::label('other_details', 'Other Details', ['style'=>'color:white;']) !!}
                            </div>
                            <div class="input-group form-group-no-border input-lg{{ $errors->has('other_details') ? ' has-error' : '' }}">
                                <textarea id="other_details" name="other_details" type="text" class="form-control" rows="4" placeholder="Other details for the reservation" style="color: white"></textarea>
                                @if ($errors->has('other_details'))
                                    <span class="badge badge-danger" style="color: white;">
                                        {{ $errors->first('other_details') }}
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="row footer text-center">
                            <button type="submit" class="col-sm-6 btn btn-primary btn-round btn-lg btn-block">Create Reservation</button>
                            <button type="button" class="col-sm-6 btn btn-warning btn-round" onclick="location.href='{{route('reservation.getUserReservation')}}'">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
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
                        {!! Form::model($reservation, ['method'=>'POST', 'action'=> ['ReservationController@updatePackageTour', $reservation->id], 'files' => true]) !!}
                        <div class="form-group{{ $errors->has('reservation_type_id') ? ' has-error' : '' }}" style="display: inline-block">
                            {!! Form::hidden('reservation_type_id', 2) !!}
                            {!! Form::label('reservation_type_id_label', 'Type of Reservation:  ') !!}
                            Tour package
                        </div>
                        @php
                            $i=1;
                        @endphp
                        <br>
                        @foreach($reservation->packageTours as $packagetour)
                            {!! Form::label('packagetour_id', 'Tour Package ' . $i) !!}
                            <div class="row form-group" id="package-tour-form">
                                <div class="col-sm-10">
                                    <input name="packagetour_id[]" multiple="multiple" type="hidden" value="{{$packagetour->id}}">
                                    <input class="form-control" disabled="disabled" name="packagetour_name[]" type="text" value="{{$packagetour->name}}" id="itinerary_id">
                                </div>
                                <button type="button" class="btn btn-primary" onclick="location.href='{{route('packagetour.show', $packagetour->id)}}'">View</button>
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
                                {!! Form::number('adult_no', $reservation->adult_no, ['class'=>'form-control']) !!}
                                @if ($errors->has('adult_no'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('adult_no') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div id="children_no" class="col-sm-6 form-group{{ $errors->has('children_no') ? ' has-error' : '' }}">
                                {!! Form::label('children_no', 'Number of children') !!}
                                {!! Form::number('children_no', $reservation->children_no, ['class'=>'form-control']) !!}
                                @if ($errors->has('children_no'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('children_no') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6 form-group{{ $errors->has('main_reservation_start') ? ' has-error' : '' }}">
                                {!! Form::label('main_reservation_start_label', 'Start date') !!}
                                {!! Form::date('main_reservation_start', null, ['class'=>'form-control', 'min'=>\Carbon\Carbon::today()->toDateString(), 'onkeydown'=>'return false']) !!}
                                @if ($errors->has('main_reservation_start'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('main_reservation_start') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-sm-6 form-group">
                                {!! Form::label('main_reservation_end_label', 'End date') !!}
                                {!! Form::date('main_reservation_end', $reservation->main_reservation_end, ['class'=>'form-control', 'disabled']) !!}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6 form-group{{ $errors->has('alternate_reservation_start') ? ' has-error' : '' }}">
                                {!! Form::label('alternate_reservation_start_label', 'Alternative start date') !!}
                                {!! Form::date('alternate_reservation_start', null, ['class'=>'form-control', 'min'=>\Carbon\Carbon::today()->toDateString(), 'onkeydown'=>'return false']) !!}
                                @if ($errors->has('alternate_reservation_start'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('alternate_reservation_start') }}</strong>
                                    </span>
                                @endif
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
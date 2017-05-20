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
                        {!! Form::model($reservation, ['method'=>'POST', 'action'=> ['ReservationController@postReviewItinerary', $reservation->id], 'files' => true]) !!}
                        <div class="form-group{{ $errors->has('reservation_type_id') ? ' has-error' : '' }}" style="display: inline-block">
                            {!! Form::hidden('reservation_type_id', 1) !!}
                            {!! Form::label('reservation_type_id_label', 'Type of Reservation:  ') !!}
                            Tour Package
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
                        <div class="form-group" id="package-tour-form">
                            {!! Form::label('packagetour_id', 'Tour Package') !!}
                            @foreach($reservation->itineraries as $itinerary)
                                {!! Form::select('packagetour_id', [''=>'Choose Options'] + $itineraries, $itinerary->id, ['class'=>'form-control', 'readonly']) !!}
                                {{--@foreach($collectionReservedPackageTourArray as $reservedPackageTour)--}}
                                {{--{!! Form::select('packagetour_id', [''=>'Choose Options'] + $packagetours, $packageTour->id, ['class'=>'form-control']) !!}--}}
                                {{--@endforeach--}}
                            @endforeach
                        </div>
                        <div class="form-group{{ $errors->has('price_type') ? ' has-error' : '' }}" style="display: inline-block">
                            {!! Form::label('price_type_label', 'Please choose:  ') !!}
                            @if($reservation->price_type == 'personal')
                                Personal
                            @elseif($reservation->price_type == 'private_group')
                                Private Group
                            @elseif($reservation->price_type == 'public_group')
                                Public Group
                            @endif

                        </div>
                        <div class="row">
                            <div id="adult_no" class="col-sm-6 form-group{{ $errors->has('adult_no') ? ' has-error' : '' }}">
                                {!! Form::label('adult_no', 'Number of adult') !!}
                                {!! Form::number('adult_no', $reservation->adult_no, ['class'=>'form-control', 'readonly']) !!}
                                @if ($errors->has('adult_no'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('adult_no') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div id="children_no" class="col-sm-6 form-group{{ $errors->has('children_no') ? ' has-error' : '' }}">
                                {!! Form::label('children_no', 'Number of children') !!}
                                {!! Form::number('children_no', $reservation->children_no, ['class'=>'form-control', 'readonly']) !!}
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
                                {!! Form::date('reservation_start', $reservation->reservation_start, ['class'=>'form-control', 'readonly']) !!}
                                @if ($errors->has('reservation_start'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('reservation_start') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-sm-6 form-group">
                                {!! Form::label('reservation_end', 'End date') !!}
                                {!! Form::date('reservation_end', $reservation->reservation_end, ['class'=>'form-control', 'readonly']) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            {!! Form::label('price', 'Price') !!}
                            {!! Form::text('price', currency($reservation->price, 'MYR', $currency['code']), ['class'=>'form-control', 'readonly']) !!}
                        </div>
                        <div class="form group">
                            {!! Form::label('remarks_label', 'Remark:') !!}
                            {!! Form::textarea('remarks', null, ['class'=>'form-control', 'rows'=>'4']) !!}
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
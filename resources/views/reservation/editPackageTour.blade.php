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
                        @if($reservation->reserveStatus->id != 1)
                            @if(Auth::user()->role_user_id != 3)
                                {!! Form::model($reservation, ['method'=>'POST', 'action'=> ['ReservationController@postReviewPackageTour', $reservation->id], 'files' => true]) !!}
                            @endif
                        @else
                            {!! Form::model($reservation, ['method'=>'POST', 'action'=> ['ReservationController@updatePackageTour', $reservation->id], 'files' => true]) !!}
                        @endif
                        <div class="form-group{{ $errors->has('reservation_type_id') ? ' has-error' : '' }}" style="display: inline-block">
                            {!! Form::hidden('reservation_type_id', 2) !!}
                            {!! Form::label('reservation_type_id_label', 'Type of Reservation:  ') !!}
                            Tour package
                        </div>
                        <div class="form-group" id="package-tour-form">
                            {!! Form::label('packagetour_id', 'Tour Package') !!}
                            @foreach($reservation->packageTour as $packagetour)
                            {!! Form::select('packagetour_id', [''=>'Choose Options'] + $packagetours, $packagetour->id, ['class'=>'form-control']) !!}
                            {{--@foreach($collectionReservedPackageTourArray as $reservedPackageTour)--}}
                            {{--{!! Form::select('packagetour_id', [''=>'Choose Options'] + $packagetours, $packageTour->id, ['class'=>'form-control']) !!}--}}
                            {{--@endforeach--}}
                            @endforeach
                        </div>
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
                            @else
                                @if($reservation->price_type == 'personal')
                                    Personal
                                @elseif($reservation->price_type == 'private_group')
                                    Private Group
                                @elseif($reservation->price_type == 'public_group')
                                    Public Group
                                @endif
                            @endif
                            @if ($errors->has('price_type'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('price_type') }}</strong>
                                    </span>
                            @endif

                            <script type="text/javascript">
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
                            <div class="col-sm-6 form-group{{ $errors->has('reservation_start') ? ' has-error' : '' }}">
                                {!! Form::label('reservation_start', 'Start date') !!}
                                {!! Form::date('reservation_start', $reservation->reservation_start, ['class'=>'form-control']) !!}
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
                        <div class="form-group">
                            @if($reservation->reserveStatus->id != 1)
                                @if(Auth::user()->role_user_id != 3)
                                    {!! Form::submit('Review Reservation', ['class'=>'btn btn-primary']) !!}
                                    <button type="button" class="btn btn-primary" onclick="location.href='{{url()->previous()}}'">Cancel</button>
                                @else
                                    <button type="button" class="btn btn-primary" onclick="location.href='{{url()->previous()}}'">Back</button>
                                @endif
                            @else
                                {!! Form::submit('Edit Reservation', ['class'=>'btn btn-primary']) !!}
                                <button type="button" class="btn btn-primary" onclick="location.href='{{url()->previous()}}'">Cancel</button>
                            @endif
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
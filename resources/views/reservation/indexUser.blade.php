@extends('layouts.app')

@section('head')
    Reservations
@endsection

@section('content')
    <div class="container" style="padding-top: 75px">
        <div class="row">
            <div class="col-md-12 col-md-offset-0">
                <div class="panel panel-default">
                    <div class="panel-heading">Reservations</div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-sm-4">
                                @if(Auth::user()->role_user_id == 3)
                                    My reservations
                                @else
                                    List of reservations
                                @endif
                            </div>
                            <div class="col-sm-4 col-sm-offset-4 form-group" style="display: inline-block;">
                                <div class="row">
                                    {!! Form::open(['method'=>'GET', 'action'=> 'ReservationController@filterReservationStatusUser']) !!}
                                        <div class="col-sm-8">
                                            {!! Form::select('reservation_status_id', [''=>'Filter Reservation'] + $reservationStatusIds, null, ['id'=>'reservation_status_id', 'class'=>'form-control']) !!}
                                        </div>
                                        <div class="col-sm-1">
                                            {!! Form::submit('Change', ['class'=>'btn btn-primary']) !!}
                                        </div>
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>User</th>
                                    <th>Type</th>
                                    <th>Price</th>
                                    <th>Status</th>
                                    <th>Date Start</th>
                                    <th>Date End</th>
                                    <th>Created</th>
                                    <th>Updated</th>
                                    <th colspan="3">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php
                                    $i = 0;
                                @endphp
                                @if($reservations)
                                    @foreach($reservations as $reservation)
                                        <tr>
                                            <td>{{$reservation->id}}</td>
                                            <td>{{$reservation->reserveUser->name}}</td>
                                            <td>{{$reservation->reserveType->name}}</td>
                                            <td>{{currency($reservation->price, currency()->config('default'), $currency['code'])}}</td>>
                                            <td>{{$reservation->reserveStatus->name}}</td>
                                            <td>{{$reservation->reservation_start}}</td>
                                            <td>{{$reservation->reservation_end}}</td>
                                            <td>{{$reservation->created_at->diffForHumans()}}</td>
                                            <td>{{$reservation->updated_at->diffForHumans()}}</td>
                                            @if($reservation->reserveStatus->id == 1)
                                                @if($reservation->reserveType->id == 1)
                                                    <td><button type="button" class="btn btn-primary" onclick="location.href='{{route('reservation.editItinerary', $reservation->id)}}'">View</button></td>
                                                @else
                                                    <td><button type="button" class="btn btn-primary" onclick="location.href='{{route('reservation.editPackageTour', $reservation->id)}}'">View</button></td>
                                                @endif
                                                <td>
                                                    {!! Form::open(['method' => 'POST', 'action' => ['ReservationController@payWithStripe', $reservation->id]]) !!}
                                                    <div>
                                                        <script
                                                                src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                                                                data-key="{{ env('STRIPE_KEY') }}"
                                                                data-amount="{{preg_replace("/[^0-9]/", "",currency($reservation->price, currency()->config('default'), $currency['code']))}}"
                                                                data-name="AlQuds Travel KK"
                                                                data-description="Payment Reservation"
                                                                data-locale="auto"
                                                                data-currency="{{$currency['code']}}">
                                                        </script>
                                                        <script>document.getElementsByClassName("stripe-button-el")["<?php echo $i ?>"].style.display = 'none';</script>
                                                        {!! Form::submit('Pay', ['class' => 'btn btn-primary']) !!}
                                                        @php
                                                            $i++;
                                                        @endphp
                                                    </div>
                                                    {!! Form::close() !!}
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        {!!  Form::open(['method' => 'DELETE', 'action' => ['ReservationController@destroy', $reservation->id]])!!}
                                                        {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                                                        {!! Form::close() !!}
                                                    </div>
                                                </td>
                                            @elseif($reservation->reserveStatus->id ==2 || $reservation->reserveStatus->id ==3)
                                                @if(Auth::user()->role_user_id == 3)
                                                    @if($reservation->reserveType->id ==1)
                                                        <td><button type="button" class="btn btn-primary" onclick="location.href='{{route('reservation.showItinerary', $reservation->id)}}'">View</button></td>
                                                    @else
                                                        <td><button type="button" class="btn btn-primary" onclick="location.href='{{route('reservation.showPackageTour', $reservation->id)}}'">View</button></td>
                                                    @endif
                                                @else
                                                    @if($reservation->reserveType->id ==1)
                                                        <td><button type="button" class="btn btn-primary" onclick="location.href='{{route('reservation.reviewItinerary', $reservation->id)}}'">Review</button></td>
                                                    @else
                                                        <td><button type="button" class="btn btn-primary" onclick="location.href='{{route('reservation.reviewPackageTour', $reservation->id)}}'">Review</button></td>
                                                    @endif
                                                @endif
                                            @elseif($reservation->reserveStatus->id ==4 || $reservation->reserveStatus->id ==5)
                                                @if(Auth::user()->role_user_id == 3)
                                                    @if($reservation->reserveType->id ==1)
                                                        <td><button type="button" class="btn btn-primary" onclick="location.href='{{route('reservation.showItinerary', $reservation->id)}}'">View</button></td>
                                                    @else
                                                        <td><button type="button" class="btn btn-primary" onclick="location.href='{{route('reservation.showPackageTour', $reservation->id)}}'">View</button></td>
                                                    @endif
                                                @else
                                                    @if($reservation->reserveType->id ==1)
                                                        <td><button type="button" class="btn btn-primary" onclick="location.href='{{route('reservation.reviewItinerary', $reservation->id)}}'">Review</button></td>
                                                    @else
                                                        <td><button type="button" class="btn btn-primary" onclick="location.href='{{route('reservation.reviewPackageTour', $reservation->id)}}'">Review</button></td>
                                                    @endif                                                    <td>
                                                        <div class="form-group">
                                                            {!!  Form::open(['method' => 'DELETE', 'action' => ['ReservationController@destroy', $reservation->id]])!!}
                                                            {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                                                            {!! Form::close() !!}
                                                        </div>
                                                    </td>
                                                @endif
                                            @endif
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                            <p>Reservation can be created through activity / tour package cart.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

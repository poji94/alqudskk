@extends('layouts.backbone')

@section('head')
    Reservations
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
    index-page
@endsection

@section('content')
    <div class="section" id="backgroundUser" data-parallax="true" style="background-image:url('/preset/backgroundDarken.jpg'); background-size: 100% 100%; background-repeat: no-repeat; height: 100vh;">
        <div class="container" style="margin-top: 30px;">
            <div class="row">
                <div class="col-md-12 offset-md-0">
                    <div class="card">
                        <br>
                        <h3 class="category" style="color: black; text-align: center;">Reservation Management</h3>
                        <p class="category" style="color: black; text-align: center;">List of created reservation.</p>
                        <br>
                        <div class="row justify-content-center">
                            <div class="col-sm-4 form-group" style="display: inline-block;">
                                {!! Form::open(['method'=>'GET', 'action'=> 'ReservationController@filterReservationStatus']) !!}
                                {!! Form::select('reservation_status_id', [''=>'Filter Reservation'] + $reservationStatusIds, null, ['id'=>'reservation_status_id', 'class'=>'form-control']) !!}
                            </div>
                            <div class="col-sm-2">
                                {!! Form::submit('Change', ['class'=>'btn btn-primary btn-round']) !!}
                                {!! Form::close() !!}
                            </div>
                        </div>
                        <div class="card-block">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead style="background-color: #9c27b0; color:white;">
                                    <tr>
                                        <th>ID</th>
                                        <th width="10%">User</th>
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
                                                <td>{{$reservation->main_reservation_start}}</td>
                                                <td>{{$reservation->main_reservation_end}}</td>
                                                <td>{{$reservation->created_at->diffForHumans()}}</td>
                                                <td>{{$reservation->updated_at->diffForHumans()}}</td>
                                                @if($reservation->reserveStatus->id == 1)
                                                    @if($reservation->reserveType->id == 1)
                                                        <td><button type="button" class="btn btn-primary btn-round" onclick="location.href='{{route('reservation.editItinerary', $reservation->id)}}'">View</button></td>
                                                    @else
                                                        <td><button type="button" class="btn btn-primary btn-round" onclick="location.href='{{route('reservation.editPackageTour', $reservation->id)}}'">View</button></td>
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
                                                            {!! Form::submit('Pay', ['class' => 'btn btn-info btn-round']) !!}
                                                            @php
                                                                $i++;
                                                            @endphp
                                                        </div>
                                                        {!! Form::close() !!}
                                                    </td>
                                                    <td><button type="button" class="btn btn-danger btn-round" data-toggle="modal" data-target="#{{$reservation->id}}">Delete</button></td>
                                                    <div class="modal fade" id="{{$reservation->id}}" role="dialog">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header justify-content-center">
                                                                    <h4 class="modal-title">Delete reservation confirmation</h4>
                                                                </div>
                                                                <div class="modal-body text-center">
                                                                    Reservation for {{$reservation->reserveUser->name}} will be deleted. Continue?
                                                                </div>
                                                                <div class="modal-footer justify-content-center">
                                                                    {!!  Form::open(['method' => 'DELETE', 'action' => ['ReservationController@destroy', $reservation->id]])!!}
                                                                    {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-round']) !!}
                                                                    <button type="button" class="btn btn-primary btn-round" data-dismiss="modal">Cancel</button>
                                                                    {!! Form::close() !!}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @elseif($reservation->reserveStatus->id ==2 || $reservation->reserveStatus->id ==3)
                                                    @if(Auth::user()->role_user_id == 3)
                                                        @if($reservation->reserveType->id ==1)
                                                            <td><button type="button" class="btn btn-primary btn-round" onclick="location.href='{{route('reservation.showItinerary', $reservation->id)}}'">View</button></td>
                                                        @else
                                                            <td><button type="button" class="btn btn-primary btn-round" onclick="location.href='{{route('reservation.showPackageTour', $reservation->id)}}'">View</button></td>
                                                        @endif
                                                    @else
                                                        @if($reservation->reserveType->id ==1)
                                                            <td><button type="button" class="btn btn-primary btn-round" onclick="location.href='{{route('reservation.reviewItinerary', $reservation->id)}}'">Review</button></td>
                                                        @else
                                                            <td><button type="button" class="btn btn-primary btn-round" onclick="location.href='{{route('reservation.reviewPackageTour', $reservation->id)}}'">Review</button></td>
                                                        @endif
                                                    @endif
                                                @elseif($reservation->reserveStatus->id ==4 || $reservation->reserveStatus->id ==5)
                                                    @if(Auth::user()->role_user_id == 3)
                                                        @if($reservation->reserveType->id ==1)
                                                            <td><button type="button" class="btn btn-primary btn-round" onclick="location.href='{{route('reservation.showItinerary', $reservation->id)}}'">View</button></td>
                                                        @else
                                                            <td><button type="button" class="btn btn-primary btn-round" onclick="location.href='{{route('reservation.showPackageTour', $reservation->id)}}'">View</button></td>
                                                        @endif
                                                    @else
                                                        @if($reservation->reserveType->id ==1)
                                                            <td><button type="button" class="btn btn-primary btn-round" onclick="location.href='{{route('reservation.reviewItinerary', $reservation->id)}}'">Review</button></td>
                                                        @else
                                                            <td><button type="button" class="btn btn-primary btn-round" onclick="location.href='{{route('reservation.reviewPackageTour', $reservation->id)}}'">Review</button></td>
                                                        @endif
                                                        <td><button type="button" class="btn btn-danger btn-round" data-toggle="modal" data-target="#{{$reservation->id}}">Delete</button></td>
                                                        <div class="modal fade" id="{{$reservation->id}}" role="dialog">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header justify-content-center">
                                                                        <h4 class="modal-title">Delete reservation confirmation</h4>
                                                                    </div>
                                                                    <div class="modal-body text-center">
                                                                        Reservation for {{$reservation->reserveUser->name}} will be deleted. Continue?
                                                                    </div>
                                                                    <div class="modal-footer justify-content-center">
                                                                        {!!  Form::open(['method' => 'DELETE', 'action' => ['ReservationController@destroy', $reservation->id]])!!}
                                                                        {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-round']) !!}
                                                                        <button type="button" class="btn btn-primary btn-round" data-dismiss="modal">Cancel</button>
                                                                        {!! Form::close() !!}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endif
                                            </tr>
                                        @endforeach
                                    @endif
                                    </tbody>
                                </table>
                                <p>Reservation can be created through activity / tour package cart.</p>
                            </div>
                            <div class="tab-content text-center">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if(Session::has('created_reservation'))
        <script type="text/javascript">
            $(window).on('load',function(){
                $('#created_reservation').modal('show');
            });
        </script>
        <div class="modal fade" id="created_reservation" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header justify-content-center">
                        <h4 class="modal-title">Reservation created</h4>
                    </div>
                    <div class="modal-body text-center">
                        {{session('created_reservation')}}
                    </div>
                    <div class="modal-footer justify-content-center">
                        <button type="button" class="btn btn-primary btn-round" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    @endif
    @if(Session::has('paid_reservation'))
        <script type="text/javascript">
            $(window).on('load',function(){
                $('#paid_reservation').modal('show');
            });
        </script>
        <div class="modal fade" id="paid_reservation" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header justify-content-center">
                        <h4 class="modal-title">Reservation updated</h4>
                    </div>
                    <div class="modal-body text-center">
                        {{session('paid_reservation')}}
                    </div>
                    <div class="modal-footer justify-content-center">
                        <button type="button" class="btn btn-primary btn-round" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    @endif
    @if(Session::has('updated_reservation'))
        <script type="text/javascript">
            $(window).on('load',function(){
                $('#updated_reservation').modal('show');
            });
        </script>
        <div class="modal fade" id="updated_reservation" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header justify-content-center">
                        <h4 class="modal-title">Reservation updated</h4>
                    </div>
                    <div class="modal-body text-center">
                        {{session('updated_reservation')}}
                    </div>
                    <div class="modal-footer justify-content-center">
                        <button type="button" class="btn btn-primary btn-round" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    @endif
    @if(Session::has('deleted_reservation'))
        <script type="text/javascript">
            $(window).on('load',function(){
                $('#deleted_reservation').modal('show');
            });
        </script>
        <div class="modal fade" id="deleted_reservation" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header justify-content-center">
                        <h4 class="modal-title">Reservation deleted</h4>
                    </div>
                    <div class="modal-body text-center">
                        {{session('deleted_reservation')}}
                    </div>
                    <div class="modal-footer justify-content-center">
                        <button type="button" class="btn btn-primary btn-round" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection

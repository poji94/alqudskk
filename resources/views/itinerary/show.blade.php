@extends('layouts.app')

@section('head')
    {{$itinerary->name}}
@endsection

@section('styles')
    .carousel-inner > .item > img,
    .carousel-inner > .item > a > img {
        margin: auto;
    }
@endsection

@section('content')
    <div class="container" style="padding-top: 75px">
        <div class="row">
            <div class="col-sm-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">View Activity</div>

                    <div class="panel-body">
                        {!! Form::label('activity_label', 'Activity Details') !!}
                        <div class="row">
                            <div class="col-sm-5">
                                <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                    <!-- Indicators -->
                                    <ol class="carousel-indicators">
                                        @php
                                            $i = 0;
                                        @endphp
                                        @foreach($itinerary->medias as $media)
                                            @if($i == 0)
                                                <li data-target="#myCarousel" data-slide-to="{{$i}}" class="active"></li>
                                            @else
                                                <li data-target="#myCarousel" data-slide-to="{{$i}}"></li>
                                            @endif
                                            @php
                                                $i++;
                                            @endphp
                                        @endforeach
                                    </ol>

                                    <!-- Wrapper for slides -->
                                    <div class="carousel-inner" role="listbox">
                                        @php
                                            $i = 0;
                                        @endphp
                                        @foreach($itinerary->medias as $media)
                                            @if($i == 0)
                                                <div class="item active">
                                                    <img src="{{ $media->path }}" class="img-responsive img-rounded" alt="" width="460" height="345">
                                                </div>
                                            @else
                                                <div class="item">
                                                    <img src="{{ $media->path }}" class="img-responsive img-rounded" alt="" width="460" height="345">
                                                </div>
                                            @endif
                                            @php
                                                $i++;
                                            @endphp
                                        @endforeach
                                    </div>
                                    <!-- Left and right controls -->
                                    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                                        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                                        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                @include('includes.form_error')
                                {!! Form::label('name_label', 'Name: ') !!}<br>
                                {{ $itinerary ->name }} <br><br>

                                {!! Form::label('pickup_dropoff_label', 'Pickup and Dropoff: ') !!}
                                <div class="responsive-table">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th class="col-sm-2">Option 1</th>
                                            <th class="col-sm-6">Place</th>
                                            <th class="col-sm-2">Time</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>Pick-up</td>
                                            <td>{{$itinerary->option1_pickup_place}}</td>
                                            <td>{{$itinerary->option1_pickup_time}}</td>
                                        </tr>
                                        <tr>
                                            <td>Drop-off</td>
                                            <td>{{$itinerary->option1_dropoff_place}}</td>
                                            <td>{{$itinerary->option1_dropoff_time}}</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                @if($itinerary->option2_pickup_place != null)
                                    <div class="responsive-table">
                                        <table class="table">
                                            <thead>
                                            <tr>
                                                <th class="col-sm-2">Option 2</th>
                                                <th class="col-sm-6">Place</th>
                                                <th class="col-sm-2">Time</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td>Pick-up</td>
                                                <td>{{$itinerary->option2_pickup_place}}</td>
                                                <td>{{$itinerary->option2_pickup_time}}</td>
                                            </tr>
                                            <tr>
                                                <td>Drop-off</td>
                                                <td>{{$itinerary->option2_dropoff_place}}</td>
                                                <td>{{$itinerary->option2_dropoff_time}}</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                @endif
                                {!! Form::label('description_label', 'Description: ') !!}<br>
                                {{$itinerary->description}} <br><br>

                                {!! Form::label('duration_label', 'Duration: ') !!}<br>
                                @if($itinerary->duration >= 6)
                                    Full-day <br><br>
                                @else
                                    {{$itinerary->duration}} Hour <br><br>
                                @endif
                                {!! Form::label('price_currency_label', 'Price Currency:') !!}<br>
                                <div class="row form-group">
                                    {!! Form::open(['method'=>'GET', 'action'=> 'ItineraryController@changeCurrency']) !!}
                                    <div class="col-sm-10">
                                        {!! Form::select('currency_drop_down', [''=>'Choose Options'] + $currencies, $currency['id'], ['id'=>'currency_drop_down', 'class'=>'form-control']) !!}
                                    </div>
                                    <div class="col-sm-2">
                                        {!! Form::hidden('id', $itinerary->id) !!}
                                        {!! Form::submit('Change', ['class'=>'btn btn-primary']) !!}
                                    </div>
                                    {!! Form::close() !!}
                                </div>
                                <div class="responsive-table">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th>Category</th>
                                            <th>Adult</th>
                                            <th>Child</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($itinerary->prices as $price)
                                            <tr>
                                                <td>Personal</td>
                                                <td>{{currency($price->personal, 'MYR', $currency['code'])}}</td>
                                                <td>-</td>
                                            </tr>
                                            <tr>
                                                <td>Private Group</td>
                                                <td>{{currency($price->private_group_adult, 'MYR', $currency['code'])}}</td>
                                                <td>{{currency($price->private_group_children, 'MYR', $currency['code'])}}</td>
                                            </tr>
                                            <tr>
                                                <td>Public Group</td>
                                                <td>{{currency($price->public_group_adult, 'MYR', $currency['code'])}}</td>
                                                <td>{{currency($price->public_group_children, 'MYR', $currency['code'])}}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                @if(Auth::guest())
                                    <button type="button" class="btn btn-primary" onclick="location.href='{{url('/login')}}'">Book Now</button>
                                @else
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#option">Book Now</button>

                                    <div class="modal fade" id="option" role="dialog">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Choose option for pickup and dropoff</h4>
                                                </div>
                                                <div class="row modal-body">
                                                    <div class="col-sm-10">
                                                        {!! Form::open(['method'=>'POST', 'action'=> 'ReservationController@createItinerary']) !!}
                                                            {!! Form::hidden('id', $itinerary->id) !!}
                                                            @if($itinerary->option2_pickup_place != null)
                                                                {!! Form::select('option', [''=>'Choose Options', '1'=>'Option 1 ('. $itinerary->option1_pickup_time . ' -> ' . $itinerary->option1_dropoff_time .')', '2'=>'Option 2 ('. $itinerary->option2_pickup_time . ' -> ' . $itinerary->option2_dropoff_time .')'], null, [ 'class'=>'form-control']) !!}
                                                            @else
                                                                {!! Form::select('option', [''=>'Choose Options', '1'=>'Option 1 ('. $itinerary->option1_pickup_time . ' -> ' . $itinerary->option1_dropoff_time .')'], null, [ 'class'=>'form-control']) !!}
                                                            @endif
                                                    </div>
                                                    <div class="col-sm-2">
                                                            {!! Form::submit('Submit', ['class'=>'btn btn-primary']) !!}
                                                        {!! Form::close() !!}
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-sm-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Suggestion for places nearby {{$itinerary->places->first()->name}}</div>
                    <div class="panel-body">
                        @if($selectedPlaceItineraries)
                            @foreach($selectedPlaceItineraries as $selectedPlaceItinerary)
                                @if($selectedPlaceItinerary->id == $itinerary->id)

                                @else
                                    <div class="row page-header">
                                        @php
                                            $i = 0;
                                        @endphp
                                        @foreach($selectedPlaceItinerary->medias as $media)
                                            @if($i == 0)
                                                <div class="col-sm-4">
                                                    <img src="{{$media->path}}" class="img-responsive img-rounded" alt="" style="height: 150px; width: 230px;">
                                                </div>
                                            @endif
                                            @php
                                                $i++;
                                            @endphp
                                        @endforeach
                                        <div class="col-sm-6">
                                            Name: {{ $selectedPlaceItinerary->name }} <br>
                                            Duration: {{ $selectedPlaceItinerary->duration }} <br>
                                            <button type="button" class="btn btn-primary" onclick="location.href='{{route('itinerary.show', $selectedPlaceItinerary->id)}}'">View</button>
                                            @if(Auth::guest())
                                                <button type="button" class="btn btn-primary" onclick="location.href='{{url('/login')}}'">Book Now</button>
                                            @else
                                                <button type="button" class="btn btn-primary" onclick="location.href='{{route('reservation.createItinerary', $selectedPlaceItinerary->id)}}'">Book Now</button>
                                            @endif
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-sm-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Suggestion for similar type: {{$itinerary->types->first()->name}}</div>
                    <div class="panel-body">
                        @if($selectedTypeItineraries)
                            @foreach($selectedTypeItineraries as $selectedTypeItinerary)
                                @if($selectedTypeItinerary->id == $itinerary->id)

                                @else
                                    <div class="row page-header">
                                        @php
                                            $i = 0;
                                        @endphp
                                        @foreach($selectedTypeItinerary->medias as $media)
                                            @if($i == 0)
                                                <div class="col-sm-4">
                                                    <img src="{{$media->path}}" class="img-responsive img-rounded" alt="" style="height: 150px; width: 230px;">
                                                </div>
                                            @endif
                                            @php
                                                $i++;
                                            @endphp
                                        @endforeach
                                        <div class="col-sm-6">
                                            Name: {{ $selectedTypeItinerary->name }} <br>
                                            Duration: {{ $selectedTypeItinerary->duration }} <br>
                                            <button type="button" class="btn btn-primary" onclick="location.href='{{route('itinerary.show', $selectedTypeItinerary->id)}}'">View</button>
                                            @if(Auth::guest())
                                                <button type="button" class="btn btn-primary" onclick="location.href='{{url('/login')}}'">Book Now</button>
                                            @else
                                                <button type="button" class="btn btn-primary" onclick="location.href='{{route('reservation.createItinerary', $selectedTypeItinerary->id)}}'">Book Now</button>
                                            @endif
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
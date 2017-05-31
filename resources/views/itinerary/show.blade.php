@extends('layouts.backbone')

@section('head')
    {{$itinerary->name}}
@endsection

@section('styles')
    .carousel-inner > .item > img,
    .carousel-inner > .item > a > img {
        margin: auto;
    }

@endsection

@section('bodyClass')
    index-page
@endsection

@section('titlePage')
    <div class="wrapper">
        <div class="page-header">
            <div id="myCarousel" class="carousel slide page-header-image" data-parallax="true" style="height: 100vh; width: 100vw;">
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
                <div class="carousel-inner" role="listbox">
                    @php
                        $i = 0;
                    @endphp
                    @foreach($itinerary->medias as $media)
                        @if($i == 0)
                            <div class="carousel-item active">
                                <img src="{{ $media->path }}" alt="" style="height: 150vh; width: 100vw;">
                            </div>
                            {{--<div class="carousel-caption d-none d-md-block">--}}
                            {{--<h5>Nature, United States</h5>--}}
                            {{--</div>--}}
                        @else
                            <div class="carousel-item">
                                <img src="{{ $media->path }}" alt="" style="height: 100vh; width: 100vw;">
                            </div>
                            {{--<div class="carousel-caption d-none d-md-block">--}}
                            {{--<h5>Nature, United States</h5>--}}
                            {{--</div>--}}
                        @endif
                        @php
                            $i++;
                        @endphp
                    @endforeach
                </div>
                {{--<a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">--}}
                    {{--<i class="now-ui-icons arrows-1_minimal-left"></i>--}}
                {{--</a>--}}
                {{--<a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">--}}
                    {{--<i class="now-ui-icons arrows-1_minimal-right"></i>--}}
                {{--</a>--}}
            </div>
            <div class="container">
                <h3 class="category category-absolute" style="color: white;">{{$itinerary->name}}</h3>
            </div>
        </div>
    </div>
    <div class="main">
        <div class="section">
            <div class="container">
                <h3 class="title">{{$itinerary->name}}</h3>
                <div class="row">
                    <div class="col-md-4">
                        {!! Form::label('pickup_dropoff_label', 'Pickup and Dropoff: ') !!}
                        <div class="responsive-table">
                            <table class="table">
                                <thead style="background-color: #9c27b0; color:white;">
                                <tr>
                                    <th width="50%">Option 1</th>
                                    <th>Place</th>
                                    <th>Time</th>
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
                                    <thead style="background-color: #9c27b0; color:white;">
                                    <tr>
                                        <th width="50%">Option 2</th>
                                        <th>Place</th>
                                        <th>Time</th>
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
                    </div>
                    <div class="col-md-8">
                        <img class="rounded img-raised" src="/media/photo_{{$itinerary->name}}_0.jpg" alt="picture" style="width: 720px;">
                    </div>
                </div>
            </div>
        </div>
        <div class="section">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <img class="rounded img-raised" src="/media/photo_{{$itinerary->name}}_1.jpg" alt="picture" style="width: 720px;">
                    </div>
                    <div class="col-md-4">
                        {!! Form::label('description_label', 'Description: ') !!}<br>
                        {{$itinerary->description}} <br><br>

                        {!! Form::label('duration_label', 'Duration: ') !!}<br>
                        @if($itinerary->duration >= 6)
                            Full-day <br><br>
                        @else
                            {{$itinerary->duration}} Hour <br><br>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="section">
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        {!! Form::label('price_currency_label', 'Price Currency:') !!}<br>
                            <div class="row">
                                <div class="col-md-8 form-group">
                                    {!! Form::open(['method'=>'GET', 'action'=> 'ItineraryController@changeCurrency']) !!}
                                    {!! Form::select('currency_drop_down', [''=>'Choose Options'] + $currencies, $currency['id'], ['id'=>'currency_drop_down', 'class'=>'form-control']) !!}
                                    {!! Form::hidden('id', $itinerary->id) !!}
                                </div>
                                <div class="col-md-2">
                                    {!! Form::submit('Change', ['class'=>'btn btn-primary btn-round', 'style'=>'display: inline;']) !!}
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        <div class="responsive-table">
                            <table class="table">
                                <thead style="background-color: #9c27b0; color:white;">
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
                            <button type="button" class="btn btn-info btn-round" onclick="location.href='{{url('/login')}}'">Book Now</button>
                        @else
                            <button type="button" class="btn btn-info btn-round" data-toggle="modal" data-target="#option">Book Now</button>

                            <div class="modal fade" id="option" role="dialog">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title justify-content-center">Choose option for pickup and dropoff</h4>
                                        </div>
                                        <div class="row modal-body justify-content-center">
                                            <div class="col-sm-10">
                                                {!! Form::open(['method'=>'POST', 'action'=> 'ReservationController@createItinerary']) !!}
                                                {!! Form::hidden('id', $itinerary->id) !!}
                                                @if($itinerary->option2_pickup_place != null)
                                                    {!! Form::select('option', [''=>'Choose Options', '1'=>'Option 1 ('. $itinerary->option1_pickup_time . ' -> ' . $itinerary->option1_dropoff_time .')', '2'=>'Option 2 ('. $itinerary->option2_pickup_time . ' -> ' . $itinerary->option2_dropoff_time .')'], null, [ 'class'=>'form-control']) !!}
                                                @else
                                                    {!! Form::select('option', [''=>'Choose Options', '1'=>'Option 1 ('. $itinerary->option1_pickup_time . ' -> ' . $itinerary->option1_dropoff_time .')'], null, [ 'class'=>'form-control']) !!}
                                                @endif
                                            </div>
                                        </div>
                                        <div class="modal-footer justify-content-center">
                                            {!! Form::submit('Book Now', ['class'=>'btn btn-info btn-round']) !!}
                                            {!! Form::close() !!}
                                            <button type="button" class="btn btn-warning btn-round" data-dismiss="modal">Cancel</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="col-md-8">
                        <img class="rounded img-raised" src="/media/photo_{{$itinerary->name}}_2.jpg" alt="picture" style="width: 720px;">
                    </div>
                </div>
            </div>
        </div>
        <div class="section">
            <h3 class="title text-center">Activities nearby {{$itinerary->places->first()->name}}</h3>
            {{--<div class="card" style="background-color: rgb(171, 71, 188); width:100vw;">--}}
            <div class="card" style="background-image: url('/preset/backgroundItineraryMoreDarken.png'); background-size: 100% 100%; width:100vw;">
                <div class="row" style=" overflow: auto;">
                    @if($selectedPlaceItineraries)
                        @foreach($selectedPlaceItineraries as $selectedPlaceItinerary)
                            @if($selectedPlaceItinerary->id == $itinerary->id)
                            @else
                                @php
                                    $i = 0;
                                @endphp
                                @foreach($selectedPlaceItinerary->medias as $media)
                                    @if($i == 0)
                                        <div class="col-sm-3" style="margin-top: 15px;">
                                            <a href="{{route('itinerary.show', $selectedPlaceItinerary->id)}}">
                                                <img src="{{$media->path}}" class="img-responsive img-rounded" alt="" style="width: 100vw; height: 35vh;">
                                                <p class="category text-center" style="color: white;">{{$selectedPlaceItinerary->name}}</p>
                                            </a>
                                        </div>
                                    @endif
                                    @php
                                        $i++;
                                    @endphp
                                @endforeach
                            @endif
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
        <div class="section" style="margin-top: -70px;">
            <h3 class="title text-center">You may also interested other {{$itinerary->types->first()->name}} like..</h3>
            {{--<div class="card" style="background-color: rgb(171, 71, 188); width:100vw;">--}}
            <div class="card" style="background-image: url('/preset/backgroundPackageTourMoreDarken.jpg'); background-size: 100% 100%; width:100vw;">
                <div class="row" style=" overflow: auto;">
                    @if($selectedTypeItineraries)
                        @foreach($selectedTypeItineraries as $selectedTypeItinerary)
                            @if($selectedTypeItinerary->id == $itinerary->id)
                            @else
                                @php
                                    $i = 0;
                                @endphp
                                @foreach($selectedTypeItinerary->medias as $media)
                                    @if($i == 0)
                                        <div class="col-sm-3" style="margin-top: 15px;">
                                            <a href="{{route('itinerary.show', $selectedTypeItinerary->id)}}">
                                                <img src="{{$media->path}}" class="img-responsive img-rounded" alt="" style="width: 100vw; height: 35vh;">
                                                <p class="category text-center" style="color: white;">{{$selectedTypeItinerary->name}}</p>
                                            </a>
                                        </div>
                                    @endif
                                    @php
                                        $i++;
                                    @endphp
                                @endforeach
                            @endif
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
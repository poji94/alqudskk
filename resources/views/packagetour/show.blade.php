@extends('layouts.backbone')

@section('head')
    {{$packageTour->name}}
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
                    @foreach($packageTour->medias as $media)
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
                    @foreach($packageTour->medias as $media)
                        @if($i == 0)
                            <div class="carousel-item active">
                                <img src="{{ $media->path }}" alt="" style="height: 100vh; width: 100vw;">
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
                <h3 class="category category-absolute" style="color: white;">{{$packageTour->name}}</h3>
            </div>
        </div>
    </div>
    <div class="main">
        <div class="section">
            <div class="container">
                <h3 class="title">{{$packageTour->name}}</h3>
                <div class="row">
                    <div class="col-md-4">
                        {!! Form::label('activity_label', 'Activities included: ') !!}<br>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th class="col-sm-6">Activity</th>
                                    <th class="col-sm-2">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($packageTour->itineraries as $itinerary)
                                    <tr>
                                        <td>{{$itinerary->name}}</td>
                                        <td> <button type="button" class=" btn btn-primary" onclick="location.href='{{ route('itinerary.show', $itinerary->id) }}'">View</button></td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <img class="rounded img-raised" src="/media/photo_{{$packageTour->name}}_0.jpg" alt="picture" style="width: 720px;">
                    </div>
                </div>
            </div>
        </div>
        <div class="section">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <img class="rounded img-raised" src="/media/photo_{{$packageTour->name}}_1.jpg" alt="picture" style="width: 720px;">
                    </div>
                    <div class="col-md-4">
                        {!! Form::label('description_label', 'Description: ') !!}<br>
                        {{$packageTour->description}} <br><br>

                        {!! Form::label('duration_label', 'Duration') !!}<br>
                        {{ $packageTour->duration }} days<br><br>
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
                                {!! Form::open(['method'=>'GET', 'action'=> 'PackageTourController@changeCurrency']) !!}
                                {!! Form::select('currency_drop_down', [''=>'Choose Options'] + $currencies, $currency['id'], ['id'=>'currency_drop_down', 'class'=>'form-control']) !!}
                                {!! Form::hidden('id', $packageTour->id) !!}
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
                                @foreach($packageTour->prices as $price)
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
                            <button type="button" class="btn btn-primary" onclick="location.href='{{route('reservation.createPackageTour', $packageTour->id)}}'">Book Now</button>
                        @endif
                    </div>
                    <div class="col-md-8">
                        <img class="rounded img-raised" src="/media/photo_{{$packageTour->name}}_2.jpg" alt="picture" style="width: 720px;">
                    </div>
                </div>
            </div>
        </div>
        <div class="section">
            <h3 class="title text-center">Activities nearby {{$packageTour->places->first()->name}}</h3>
            <div class="card" style="background-color: rgb(171, 71, 188); width:100vw;">
                <div class="row" style=" overflow: auto;">
                    @if($selectedPlacePackageTours)
                        @foreach($selectedPlacePackageTours as $selectedPlacePackageTour)
                            @if($selectedPlacePackageTour->id == $packageTour->id)
                            @else
                                @php
                                    $i = 0;
                                @endphp
                                @foreach($selectedPlacePackageTour->medias as $media)
                                    @if($i == 0)
                                        <div class="col-sm-3" style="margin-top: 15px;">
                                            <a href="{{route('packagetour.show', $selectedPlacePackageTour->id)}}">
                                                <img src="{{$media->path}}" class="img-responsive img-rounded" alt="" style="width: 100vw; height: 35vh;">
                                                <p class="category text-center" style="color: white;">{{$selectedPlacePackageTour->name}}</p>
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
            <h3 class="title text-center">You may also interested other {{$packageTour->types->first()->name}} like..</h3>
            <div class="card" style="background-color: rgb(171, 71, 188); width:100vw;">
                <div class="row" style=" overflow: auto;">
                    @if($selectedTypePackageTours)
                        @foreach($selectedTypePackageTours as $selectedTypePackageTour)
                            @if($selectedTypePackageTour->id == $packageTour->id)
                            @else
                                @php
                                    $i = 0;
                                @endphp
                                @foreach($selectedTypePackageTour->medias as $media)
                                    @if($i == 0)
                                        <div class="col-sm-3" style="margin-top: 15px;">
                                            <a href="{{route('packagetour.show', $selectedTypePackageTour->id)}}">
                                                <img src="{{$media->path}}" class="img-responsive img-rounded" alt="" style="width: 100vw; height: 35vh;">
                                                <p class="category text-center" style="color: white;">{{$selectedTypePackageTour->name}}</p>
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
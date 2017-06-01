@extends('layouts.backbone')

@section('head')
    Tour Packages
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

@section('content')
    <div class="section" id="backgroundUser" data-parallax="true" style="background-image:url('/preset/backgroundPackageTourDarken.jpg'); background-size: 100% 100%; background-repeat: no-repeat; height: 100vh;">
        <div class="container" style="margin-top: 35px;">
            <div class="row">
                <div class="col-md-4" style="margin-top: 50px;">
                    <div class="card ">
                        <br>
                        <p class="category" style="color: black; text-align: center;">Tour Package Selection</p>
                        <br>
                        <div class="card-block">
                            <div class="text-center">
                                {!! Form::label('title_label', 'Please choose your selection') !!}
                            </div>
                            {!! Form::open(['method'=>'GET', 'action'=> 'PackageTourController@filterSelection']) !!}
                            <div class="row">
                                <div class="col-sm-6 form-group">
                                    {!! Form::label('place_tourism','Location') !!}
                                    {!! Form::select('place_tourism', [''=>'Choose Options'] + $placetourism, null,['class'=>'form-control']) !!}
                                </div>
                                <div class="col-sm-6 form-group">
                                    {!! Form::label('type_vacation','Type of vacation') !!}
                                    {!! Form::select('type_vacation', [''=>'Choose Options'] + $typevacation, null, ['class'=>'form-control']) !!}
                                </div>
                            </div>
                            <div class="text-center">
                                {!! Form::submit('Submit', ['class'=>'btn btn-primary btn-round']) !!}
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                    <div class="tab-content text-center">
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card" style="height: 80vh;">
                        <br>
                        <p class="category" style="color: black; text-align: center;">List of Tour Packages found</p>
                        <br>
                        <div class="card-block" style="height: 70vh; overflow:auto;">
                            <div class="container">
                                <div class="row" >
                                    @if($selectedPackageTours)
                                        @foreach($selectedPackageTours as $selectedPackageTour)
                                            @php
                                                $i = 0;
                                            @endphp
                                            @foreach($selectedPackageTour->medias as $media)
                                                @if($i == 0)
                                                    <div class="col-sm-4">
                                                        <img src="{{$media->path}}" class="img-responsive img-rounded img-raised" alt="" style="height: 150px; width: 230px;">
                                                    </div>
                                                @endif
                                                @php
                                                    $i++;
                                                @endphp
                                            @endforeach
                                            <div class="col-sm-6">
                                                Name: {{ $selectedPackageTour->name }} <br>
                                                <button type="button" class="btn btn-primary btn-round" onclick="location.href='{{route('packagetour.show', $selectedPackageTour->id)}}'">View</button>
                                                @if(Auth::guest())
                                                    <button type="button" class="btn btn-info btn-round" onclick="location.href='{{url('/login')}}'">Book Now</button>
                                                @else
                                                    <span>
                                                        <div style="display: inline-block;">
                                                            {!! Form::open(['method'=>'POST', 'action'=> 'ReservationController@createPackageTour']) !!}
                                                            {!! Form::hidden('id', $selectedPackageTour->id) !!}
                                                            {!! Form::submit('Book Now', ['class'=>'btn btn-info btn-round']) !!}
                                                            {!! Form::close() !!}
                                                        </div>
                                                    </span>
                                                @endif
                                            </div>
                                            <br>
                                        @endforeach
                                    @endif
                                </div>
                                <div class="row">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-content text-center">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
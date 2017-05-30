@extends('layouts.backbone')

@section('head')
    View Activity
@endsection

@section('style')
    .carousel-inner > .item > img,
    .carousel-inner > .item > a > img {
        margin: auto;
    }

    body {
        background: url('/preset/backgroundDarken.jpg') no-repeat center center fixed;
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
        <div class="container col-md-8">
            <div class="content-center" style="margin-top: 75px;">
                <div class="card card-plain">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-6">
                                <div id="myCarousel" class="carousel slide">
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
                                                    <img src="{{ $media->path }}" alt="" width="460" height="345">
                                                </div>
                                                {{--<div class="carousel-caption d-none d-md-block">--}}
                                                {{--<h5>Nature, United States</h5>--}}
                                                {{--</div>--}}
                                            @else
                                                <div class="carousel-item">
                                                    <img src="{{ $media->path }}" alt="" width="460" height="345">
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
                                    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                                        <i class="now-ui-icons arrows-1_minimal-left"></i>
                                    </a>
                                    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                                        <i class="now-ui-icons arrows-1_minimal-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <form class="form" method="POST" action="{{url('itinerary/' . $itinerary->id)}}" enctype="multipart/form-data">
                        <input name="_method" type="hidden" value="PATCH">
                        {{ csrf_field() }}
                        <div class="header header-primary text-center">
                            <h3 style="color: white;">Edit {{$itinerary->name}} activity information.</h3>
                        </div>
                        <div class="content">
                            <div class="input-group form-group-no-border input-lg{{ $errors->has('name') ? ' has-error' : '' }}">
                                <input id="name" name="name" type="text" class="form-control" placeholder="Name" style="color: white" value="{{$itinerary->name}}">
                                @if ($errors->has('name'))
                                    <span class="form-control form-control-danger" style="color: white;">
                                        {{ $errors->first('name') }}
                                     </span>
                                @endif
                            </div>
                            <div class="input-group form-group-no-border input-lg{{ $errors->has('description') ? ' has-error' : '' }}">
                                <textarea id="description" name="description" type="text" class="form-control" rows="4" placeholder="Description of the activity" style="color: white;">{{$itinerary->description}}</textarea>
                                @if ($errors->has('description'))
                                    <span class="form-control form-control-danger" style="color: white;">
                                        {{ $errors->first('description') }}
                                    </span>
                                @endif
                            </div>
                            <div class="input-group form-group-no-border input-lg{{ $errors->has('duration') ? ' has-error' : '' }}">
                                <input id="duration" name="duration" type="text" class="form-control" onkeypress="return isNumber(event)" placeholder="Duration in hours" style="color: white" value="{{$itinerary->duration}}">
                                <script type="text/javascript">
                                    function isNumber(evt) {
                                        evt = (evt) ? evt : window.event;
                                        var charCode = (evt.which) ? evt.which : evt.keyCode;
                                        if ( (charCode > 31 && charCode < 48) || charCode > 57) {
                                            return false;
                                        }
                                        return true;
                                    }
                                </script>
                                @if ($errors->has('duration'))
                                    <span class="form-control form-control-danger" style="color: white;">
                                        {{ $errors->first('duration') }}
                                    </span>
                                @endif
                            </div>
                            <div>
                                <br>
                                {!! Form::label('option1_pickup_label', 'Pick up option 1', ['style'=>'color: white;']) !!}
                            </div>
                            <div class="row">
                                <div class="col-sm-8 input-group form-group-no-border input-lg{{ $errors->has('option1_pickup_place') ? ' has-error' : '' }}">
                                    <input id="option1_pickup_place" name="option1_pickup_place" type="text" class="form-control" placeholder="Pickup place" style="color: white" value="{{$itinerary->option1_pickup_place}}">
                                    @if ($errors->has('option1_pickup_place'))
                                        <span class="form-control form-control-danger" style="color: white;">
                                            {{ $errors->first('option1_pickup_place') }}
                                        </span>
                                    @endif
                                </div>
                                <div class="col-sm-4 form-group form-group-no-border input-lg{{ $errors->has('option1_pickup_time') ? ' has-error' : '' }}">
                                    <input id="option1_pickup_time" name="option1_pickup_time" type="time" class="form-control" style="color: white" value="{{$itinerary->option1_pickup_time}}">
                                    @if ($errors->has('option1_pickup_time'))
                                        <span class="form-control form-control-danger" style="color: white;">
                                            {{ $errors->first('option1_pickup_time') }}
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <p style="color:white;">Drop off time will be calculated based on pickup time and activity duration</p>
                            <div class="input-group input-group form-group-no-border input-lg{{ $errors->has('option1_dropoff_place') ? ' has-error' : '' }}">
                                <input id="option1_dropoff_place" name="option1_dropoff_place" type="text" class="form-control" placeholder="Drop off place" style="color: white" value="{{$itinerary->option1_dropoff_place}}">
                                @if ($errors->has('option1_dropoff_place'))
                                    <span class="form-control form-control-danger" style="color: white;">
                                        {{ $errors->first('option1_dropoff_place') }}
                                    </span>
                                @endif
                            </div>
                            <div>
                                <br>
                                {!! Form::label('option1_pickup_label', 'Pick up option 2 (optional)', ['style'=>'color: white;']) !!}
                            </div>
                            <div class="row">
                                <div class="col-sm-8 input-group form-group-no-border input-lg{{ $errors->has('option2_pickup_place') ? ' has-error' : '' }}">
                                    <input id="option2_pickup_place" name="option2_pickup_place" type="text" class="form-control" placeholder="Pickup place" style="color: white" value="{{$itinerary->option2_pickup_place}}">
                                    @if ($errors->has('option2_pickup_place'))
                                        <span class="form-control form-control-danger" style="color: white;">
                                            {{ $errors->first('option2_pickup_place') }}
                                        </span>
                                    @endif
                                </div>
                                <div class="col-sm-4 form-group form-group-no-border input-lg{{ $errors->has('option2_pickup_time') ? ' has-error' : '' }}">
                                    <input id="option2_pickup_time" name="option2_pickup_time" type="time" class="form-control" style="color: white" value="{{$itinerary->option2_pickup_time}}">
                                    @if ($errors->has('option2_pickup_time'))
                                        <span class="form-control form-control-danger" style="color: white;">
                                            {{ $errors->first('option2_pickup_time') }}
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <p style="color:white;">Drop off time will be calculated based on pickup time and activity duration</p>
                            <div class="input-group input-group form-group-no-border input-lg{{ $errors->has('option2_dropoff_place') ? ' has-error' : '' }}">
                                <input id="option2_dropoff_place" name="option2_dropoff_place" type="text" class="form-control" placeholder="Drop off place" style="color: white" value="{{$itinerary->option2_dropoff_place}}">
                                @if ($errors->has('option2_dropoff_place'))
                                    <span class="form-control form-control-danger" style="color: white;">
                                        {{ $errors->first('option2_dropoff_place') }}
                                    </span>
                                @endif
                            </div>
                            <div>
                                <br>
                                {!! Form::label('placetourism_typevacation', 'Place of tourism and type of vacation', ['style'=>'color: white;']) !!}
                            </div>
                            <div class="row">
                                @foreach($itinerary->places as $place)
                                    <div class="col-sm-6 input-group form-group-no-border input-lg{{ $errors->has('place_tourism') ? ' has-error' : '' }}">
                                        {!! Form::select('place_tourism', [''=>'Choose Tourism Place'] + $placetourism, $place->id, ['class'=>'form-control', 'style'=>'color: white;']) !!}
                                        <style>
                                            option {
                                                color: black;
                                            }
                                        </style>
                                        @if ($errors->has('place_tourism'))
                                            <span class="form-control form-control-danger" style="color: white;">
                                            {{ $errors->first('place_tourism') }}
                                        </span>
                                        @endif
                                    </div>
                                @endforeach
                                @foreach($itinerary->types as $type)
                                    <div class="col-sm-6 input-group form-group-no-border input-lg{{ $errors->has('type_vacation') ? ' has-error' : '' }}">
                                        {!! Form::select('type_vacation', [''=>'Choose Tourism Place'] + $typevacation, $type->id, ['class'=>'form-control', 'style'=>'color: white;']) !!}
                                        <style>
                                            option {
                                                color: black;
                                            }
                                        </style>
                                        @if ($errors->has('type_vacation'))
                                            <span class="form-control form-control-danger" style="color: white;">
                                            {{ $errors->first('type_vacation') }}
                                        </span>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                            <div>
                                {!! Form::label('pricing', 'Pricing', ['style'=>'color:white;']) !!}
                            </div>
                            @foreach($itinerary->prices as $price)
                                <div class="input-group input-group form-group-no-border input-lg{{ $errors->has('personal') ? ' has-error' : '' }}">
                                    <input id="personal" name="personal" type="number" class="form-control" placeholder="Personal price" style="color: white" value="{{$price->personal}}">
                                    @if ($errors->has('personal'))
                                        <span class="form-control form-control-danger" style="color: white;">
                                            {{ $errors->first('personal') }}
                                        </span>
                                    @endif
                                </div>
                                <div class="row">
                                    <div class="col-sm-6 input-group form-group-no-border input-lg{{ $errors->has('private_group_adult') ? ' has-error' : '' }}">
                                        <input id="private_group_adult" name="private_group_adult" type="number" class="form-control" placeholder="Private Group Adult Price" style="color: white" value="{{$price->private_group_adult}}">
                                        @if ($errors->has('private_group_adult'))
                                            <span class="form-control form-control-danger" style="color: white;">
                                                {{ $errors->first('private_group_adult') }}
                                            </span>
                                        @endif
                                    </div>
                                    <div class="col-sm-6 input-group form-group-no-border input-lg{{ $errors->has('private_group_children') ? ' has-error' : '' }}">
                                        <input id="private_group_children" name="private_group_children" type="number" class="form-control" placeholder="Private Group Children Price" style="color: white" value="{{$price->private_group_children}}">
                                        @if ($errors->has('private_group_children'))
                                            <span class="form-control form-control-danger" style="color: white;">
                                                {{ $errors->first('private_group_children') }}
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6 input-group form-group-no-border input-lg{{ $errors->has('public_group_adult') ? ' has-error' : '' }}">
                                        <input id="public_group_adult" name="public_group_adult" type="number" class="form-control" placeholder="Public Group Adult Price" style="color: white" value="{{$price->public_group_adult}}">
                                        @if ($errors->has('public_group_adult'))
                                            <span class="form-control form-control-danger" style="color: white;">
                                                {{ $errors->first('public_group_adult') }}
                                            </span>
                                        @endif
                                    </div>
                                    <div class="col-sm-6 input-group form-group-no-border input-lg{{ $errors->has('public_group_children') ? ' has-error' : '' }}">
                                        <input id="public_group_children" name="public_group_children" type="number" class="form-control" placeholder="Public Group Children Price" style="color: white" value="{{$price->public_group_children}}">
                                        @if ($errors->has('public_group_children'))
                                            <span class="form-control form-control-danger" style="color: white;">
                                                {{ $errors->first('public_group_children') }}
                                            </span>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                            <div>
                                {!! Form::label('photo_media', 'Photo Media', ['style'=>'color: white;']) !!}
                            </div>
                            <div id="media-form" class="col-sm-10 input-group form-group-no-border input-lg{{ $errors->has('public_group_children') ? ' has-error' : '' }}">
                                <input multiple="multiple" accept="image/*" class="btn btn-primary btn-round" name="media_id_reference" type="file">
                                <input type="button" class="btn btn-danger btn-round" id="remove-media" value="Remove" >
                            </div>
                            <p>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#media-form").hide();
                                        var mediaFormIndex = 0;
                                        $("#add-media").click(function(){
                                            mediaFormIndex++;
                                            $(this).parent().before($("#media-form").clone().attr("id", "media-form" + mediaFormIndex));
                                            $("#media-form" + mediaFormIndex +" :input").each(function () {
                                                $(this).attr("name", "media_id[]");
                                                $(this).attr("id", $(this).attr("id") + mediaFormIndex);
                                            });
                                            $("#remove-media" + mediaFormIndex).click(function () {
                                                $(this).closest("div").remove();
                                            });
                                            $("#media-form" + mediaFormIndex).slideDown();
                                        });
                                    });
                                </script>
                            </p>
                        </div>
                        <div class="row footer text-center">
                            <input type="button" class="col-sm-4 btn btn-primary btn-round" id="add-media" value="Add Photo Media">
                            <button type="submit" class="col-sm-4 btn btn-primary btn-round btn-lg btn-block">Edit Activity</button>
                            <button type="button" class="col-sm-4 btn btn-warning btn-round" onclick="location.href='{{route('itinerary.index')}}'">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    {{--<div class="container" style="padding-top: 75px">--}}
        {{--<div class="row">--}}
            {{--<div class="col-sm-6 col-md-offset-3">--}}
                {{--<div class="panel panel-default">--}}
                    {{--<div class="panel-heading">View Activity</div>--}}
                    {{----}}
                    {{--<div id="myCarousel" class="carousel slide" data-ride="carousel">--}}
                        {{--<!-- Indicators -->--}}
                        {{--<ol class="carousel-indicators">--}}

                        {{--</ol>--}}

                        {{--<!-- Wrapper for slides -->--}}
                        {{--<div class="carousel-inner" role="listbox">--}}
                            {{--@php--}}
                                {{--$i = 0;--}}
                            {{--@endphp--}}
                            {{--@foreach($itinerary->medias as $media)--}}
                                {{--@if($i == 0)--}}
                                    {{--<div class="item active">--}}
                                        {{--<img src="{{ $media->path }}" alt="" width="460" height="345">--}}
                                    {{--</div>--}}
                                {{--@else--}}
                                    {{--<div class="item">--}}
                                        {{--<img src="{{ $media->path }}" alt="" width="460" height="345">--}}
                                    {{--</div>--}}
                                {{--@endif--}}
                                {{--@php--}}
                                    {{--$i++;--}}
                                {{--@endphp--}}
                            {{--@endforeach--}}
                        {{--</div>--}}
                        {{--<!-- Left and right controls -->--}}
                        {{--<a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">--}}
                            {{--<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>--}}
                            {{--<span class="sr-only">Previous</span>--}}
                        {{--</a>--}}
                        {{--<a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">--}}
                            {{--<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>--}}
                            {{--<span class="sr-only">Next</span>--}}
                        {{--</a>--}}
                    {{--</div>--}}

                    {{--<div class="panel-body">--}}
                        {{--{!! Form::model($itinerary, ['method'=>'PATCH', 'action'=> ['ItineraryController@update', $itinerary->id], 'files' => true]) !!}--}}
                        {{--<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">--}}
                            {{--{!! Form::label('name', 'Name') !!}--}}
                            {{--{!! Form::text('name', null, ['class'=>'form-control']) !!}--}}
                            {{--@if ($errors->has('name'))--}}
                                {{--<span class="help-block">--}}
                                        {{--<strong>{{ $errors->first('name') }}</strong>--}}
                                    {{--</span>--}}
                            {{--@endif--}}
                        {{--</div>--}}
                        {{--<div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">--}}
                            {{--{!! Form::label('description', 'Description') !!}--}}
                            {{--{!! Form::textarea('description', null, ['class'=>'form-control', 'rows'=>'4']) !!}--}}
                            {{--@if ($errors->has('description'))--}}
                                {{--<span class="help-block">--}}
                                        {{--<strong>{{ $errors->first('description') }}</strong>--}}
                                    {{--</span>--}}
                            {{--@endif--}}
                        {{--</div>--}}
                        {{--<div class="form-group{{ $errors->has('duration') ? ' has-error' : '' }}">--}}
                            {{--{!! Form::label('duration', 'Duration (in hours)') !!}--}}
                            {{--{!! Form::text('duration', null, ['class'=>'form-control', 'onkeypress'=>'return isNumber(event)']) !!}--}}
                            {{--@if ($errors->has('duration'))--}}
                                {{--<span class="help-block">--}}
                                        {{--<strong>{{ $errors->first('duration') }}</strong>--}}
                                    {{--</span>--}}
                            {{--@endif--}}
                            {{--<script type="text/javascript">--}}
                                {{--function isNumber(evt) {--}}
                                    {{--evt = (evt) ? evt : window.event;--}}
                                    {{--var charCode = (evt.which) ? evt.which : evt.keyCode;--}}
                                    {{--if ( (charCode > 31 && charCode < 48) || charCode > 57) {--}}
                                        {{--return false;--}}
                                    {{--}--}}
                                    {{--return true;--}}
                                {{--}--}}
                            {{--</script>--}}
                        {{--</div>--}}
                        {{--<div>--}}
                            {{--{!! Form::label('option1_pickup_label', 'Pick up option 1') !!}--}}
                        {{--</div>--}}
                        {{--<div class="row">--}}
                            {{--<div class="col-sm-8 form-group{{ $errors->has('option1_pickup_place') ? ' has-error' : '' }}">--}}
                                {{--{!! Form::label('option1_pickup_place_label', 'Place') !!}--}}
                                {{--{!! Form::text('option1_pickup_place', null, ['class'=>'form-control']) !!}--}}
                                {{--@if ($errors->has('option1_pickup_place'))--}}
                                    {{--<span class="help-block">--}}
                                        {{--<strong>{{ $errors->first('option1_pickup_place') }}</strong>--}}
                                    {{--</span>--}}
                                {{--@endif--}}
                            {{--</div>--}}
                            {{--<div class="col-sm-4 form-group{{ $errors->has('option1_pickup_time') ? ' has-error' : '' }}">--}}
                                {{--{!! Form::label('option1_pickup_time_label', 'Time') !!}--}}
                                {{--{!! Form::time('option1_pickup_time', null, ['class'=>'form-control']) !!}--}}
                                {{--@if ($errors->has('option1_pickup_time'))--}}
                                    {{--<span class="help-block">--}}
                                        {{--<strong>{{ $errors->first('option1_pickup_time') }}</strong>--}}
                                    {{--</span>--}}
                                {{--@endif--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div>--}}
                            {{--{!! Form::label('option1_dropoff_label', 'Drop off option 1') !!}--}}
                        {{--</div>--}}
                        {{--<div class="form-group{{ $errors->has('option1_dropoff_place') ? ' has-error' : '' }}">--}}
                            {{--{!! Form::label('option1_dropoff_place_label', 'Place') !!}--}}
                            {{--{!! Form::text('option1_dropoff_place', null, ['class'=>'form-control']) !!}--}}
                            {{--@if ($errors->has('option1_dropoff_place'))--}}
                                {{--<span class="help-block">--}}
                                    {{--<strong>{{ $errors->first('option1_dropoff_place') }}</strong>--}}
                                {{--</span>--}}
                            {{--@endif--}}
                            {{--Drop off time will be calculated based on pickup time and activity duration--}}
                        {{--</div>--}}
                        {{--<div>--}}
                            {{--{!! Form::label('option2_pickup_label', 'Pick up option 2 (optional)') !!}--}}
                        {{--</div>--}}
                        {{--<div class="row">--}}
                            {{--<div class="col-sm-8 form-group{{ $errors->has('option2_pickup_place') ? ' has-error' : '' }}">--}}
                                {{--{!! Form::label('option2_pickup_place_label', 'Place') !!}--}}
                                {{--{!! Form::text('option2_pickup_place', null, ['class'=>'form-control']) !!}--}}
                                {{--@if ($errors->has('option2_pickup_place'))--}}
                                    {{--<span class="help-block">--}}
                                        {{--<strong>{{ $errors->first('option2_pickup_place') }}</strong>--}}
                                    {{--</span>--}}
                                {{--@endif--}}
                            {{--</div>--}}
                            {{--<div class="col-sm-4 form-group{{ $errors->has('option2_pickup_time') ? ' has-error' : '' }}">--}}
                                {{--{!! Form::label('option2_pickup_time_label', 'Time') !!}--}}
                                {{--{!! Form::time('option2_pickup_time', null, ['class'=>'form-control']) !!}--}}
                                {{--@if ($errors->has('option2_pickup_time'))--}}
                                    {{--<span class="help-block">--}}
                                        {{--<strong>{{ $errors->first('option2_pickup_time') }}</strong>--}}
                                    {{--</span>--}}
                                {{--@endif--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div>--}}
                            {{--{!! Form::label('option2_dropoff_label', 'Drop off option 2') !!}--}}
                        {{--</div>--}}
                        {{--<div class="form-group{{ $errors->has('option2_dropoff_place') ? ' has-error' : '' }}">--}}
                            {{--{!! Form::label('option2_dropoff_place_label', 'Place') !!}--}}
                            {{--{!! Form::text('option2_dropoff_place', null, ['class'=>'form-control']) !!}--}}
                            {{--@if ($errors->has('option2_dropoff_place'))--}}
                                {{--<span class="help-block">--}}
                                    {{--<strong>{{ $errors->first('option2_dropoff_place') }}</strong>--}}
                                {{--</span>--}}
                            {{--@endif--}}
                            {{--Drop off time will be calculated based on pickup time and activity duration--}}
                        {{--</div>--}}
                        {{--<div class="row">--}}
                            {{--@foreach($itinerary->places as $place)--}}
                                {{--<div class="col-sm-6 form-group{{ $errors->has('place_tourism') ? ' has-error' : '' }}">--}}
                                    {{--{!! Form::label('place_tourism','Location') !!}--}}
                                    {{--{!! Form::select('place_tourism', [''=>'Choose Options'] + $placetourism, $place->id, ['class'=>'form-control']) !!}--}}
                                    {{--@if ($errors->has('place_tourism'))--}}
                                        {{--<span class="help-block">--}}
                                            {{--<strong>{{ $errors->first('place_tourism') }}</strong>--}}
                                        {{--</span>--}}
                                    {{--@endif--}}
                                {{--</div>--}}
                            {{--@endforeach--}}
                            {{--@foreach($itinerary->types as $type)--}}
                                {{--<div class="col-sm-6 form-group{{ $errors->has('type_vacation') ? ' has-error' : '' }}">--}}
                                    {{--{!! Form::label('type_vacation','Type of vacation') !!}--}}
                                    {{--{!! Form::select('type_vacation', [''=>'Choose Options'] + $typevacation, $type->id, ['class'=>'form-control']) !!}--}}
                                    {{--@if ($errors->has('type_vacation'))--}}
                                        {{--<span class="help-block">--}}
                                            {{--<strong>{{ $errors->first('type_vacation') }}</strong>--}}
                                        {{--</span>--}}
                                    {{--@endif--}}
                                {{--</div>--}}
                            {{--@endforeach--}}
                        {{--</div>--}}
                        {{--@foreach($itinerary->prices as $price)--}}
                            {{--<div>--}}
                                {{--{!! Form::label('personal', 'Personal price') !!}--}}
                            {{--</div>--}}
                            {{--<div class="row">--}}
                                {{--<div class="col-sm-6 form-group{{ $errors->has('personal') ? ' has-error' : '' }}">--}}
                                    {{--{!! Form::label('personal', 'Price per adult') !!}--}}
                                    {{--{!! Form::number('personal', $price->personal, ['class'=>'form-control']) !!}--}}
                                    {{--@if ($errors->has('personal'))--}}
                                        {{--<span class="help-block">--}}
                                        {{--<strong>{{ $errors->first('personal') }}</strong>--}}
                                    {{--</span>--}}
                                    {{--@endif--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            {{--<div>--}}
                                {{--{!! Form::label('private_group', 'Private group price') !!}--}}
                            {{--</div>--}}
                            {{--<div class="row">--}}
                                {{--<div class="col-sm-6 form-group{{ $errors->has('private_group_adult') ? ' has-error' : '' }}">--}}
                                    {{--{!! Form::label('private_group_adult', 'Price per adult') !!}--}}
                                    {{--{!! Form::number('private_group_adult', $price->private_group_adult, ['class'=>'form-control']) !!}--}}
                                    {{--@if ($errors->has('private_group_adult'))--}}
                                        {{--<span class="help-block">--}}
                                        {{--<strong>{{ $errors->first('private_group_adult') }}</strong>--}}
                                    {{--</span>--}}
                                    {{--@endif--}}
                                {{--</div>--}}
                                {{--<div class="col-sm-6 form-group{{ $errors->has('private_group_children') ? ' has-error' : '' }}">--}}
                                    {{--{!! Form::label('private_group_children', 'Price per child') !!}--}}
                                    {{--{!! Form::number('private_group_children', $price->private_group_children, ['class'=>'form-control']) !!}--}}
                                    {{--@if ($errors->has('private_group_children'))--}}
                                        {{--<span class="help-block">--}}
                                        {{--<strong>{{ $errors->first('private_group_children') }}</strong>--}}
                                    {{--</span>--}}
                                    {{--@endif--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            {{--<div>--}}
                                {{--{!! Form::label('public_group', 'Public group price') !!}--}}
                            {{--</div>--}}
                            {{--<div class="row">--}}
                                {{--<div class="col-sm-6 form-group{{ $errors->has('public_group_adult') ? ' has-error' : '' }}">--}}
                                    {{--{!! Form::label('public_group_adult', 'Price per adult') !!}--}}
                                    {{--{!! Form::number('public_group_adult', $price->public_group_adult, ['class'=>'form-control']) !!}--}}
                                    {{--@if ($errors->has('public_group_adult'))--}}
                                        {{--<span class="help-block">--}}
                                        {{--<strong>{{ $errors->first('public_group_adult') }}</strong>--}}
                                    {{--</span>--}}
                                    {{--@endif--}}
                                {{--</div>--}}
                                {{--<div class="col-sm-6 form-group{{ $errors->has('public_group_children') ? ' has-error' : '' }}">--}}
                                    {{--{!! Form::label('public_group_children', 'Price per child') !!}--}}
                                    {{--{!! Form::number('public_group_children', $price->public_group_children, ['class'=>'form-control']) !!}--}}
                                    {{--@if ($errors->has('public_group_children'))--}}
                                        {{--<span class="help-block">--}}
                                        {{--<strong>{{ $errors->first('public_group_children') }}</strong>--}}
                                    {{--</span>--}}
                                    {{--@endif--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--@endforeach--}}
                        {{--<div>--}}
                            {{--{!! Form::label('media_id', 'Media') !!}--}}
                            {{--<div class="form-group" id="media-form">--}}
                                {{--{!! Form::file('media_id_reference', array('multiple'=>'multiple', 'accept'=>'image/*', 'class'=>'btn btn-primary col-sm-10')) !!}--}}
                                {{--<input type="button" class="btn btn-danger" id="remove-media" value="Remove" >--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<p>--}}
                            {{--<script type="text/javascript">--}}
                                {{--$(document).ready(function () {--}}
                                    {{--$("#media-form").hide();--}}
                                    {{--var mediaFormIndex = 0;--}}
                                    {{--$("#add-media").click(function(){--}}
                                        {{--mediaFormIndex++;--}}
                                        {{--$(this).parent().before($("#media-form").clone().attr("id", "media-form" + mediaFormIndex));--}}
                                        {{--$("#media-form" + mediaFormIndex +" :input").each(function () {--}}
                                            {{--$(this).attr("name", "media_id[]");--}}
                                            {{--$(this).attr("id", $(this).attr("id") + mediaFormIndex);--}}
                                        {{--});--}}
                                        {{--$("#remove-media" + mediaFormIndex).click(function () {--}}
                                            {{--$(this).closest("div").remove();--}}
                                        {{--});--}}
                                        {{--$("#media-form" + mediaFormIndex).slideDown();--}}
                                    {{--});--}}
                                {{--});--}}
                            {{--</script>--}}
                        {{--</p>--}}

                        {{--<div class="form-group">--}}
                            {{--<input type="button" class="btn btn-primary" id="add-media" value="Add Photo">--}}
                            {{--{!! Form::submit('Edit Activity', ['class'=>'btn btn-primary']) !!}--}}
                            {{--<button type="button" class="btn btn-primary" onclick="location.href='{{route('itinerary.index')}}'">Cancel</button>--}}
                        {{--</div>--}}
                        {{--{!! Form::close() !!}--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
@endsection


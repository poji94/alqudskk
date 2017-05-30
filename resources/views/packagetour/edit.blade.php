@extends('layouts.backbone')

@section('head')
    View Tour Package
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
                                    <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
                                        <i class="now-ui-icons arrows-1_minimal-left"></i>
                                    </a>
                                    <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
                                        <i class="now-ui-icons arrows-1_minimal-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <form class="form" method="POST" action="{{url('packagetour/' . $packageTour->id)}}" enctype="multipart/form-data">
                        <input name="_method" type="hidden" value="PATCH">
                        {{ csrf_field() }}
                        <div class="header header-primary text-center">
                            <h3 style="color: white;">Edit {{$packageTour->name}} tour package information.</h3>
                        </div>
                        <div class="content">
                            <div class="input-group form-group-no-border input-lg{{ $errors->has('name') ? ' has-error' : '' }}">
                                <input id="name" name="name" type="text" class="form-control" placeholder="Name" style="color: white" value="{{$packageTour->name}}">
                                @if ($errors->has('name'))
                                    <span class="form-control form-control-danger" style="color: white;">
                                        {{ $errors->first('name') }}
                                     </span>
                                @endif
                            </div>
                            <div class="input-group form-group-no-border input-lg{{ $errors->has('description') ? ' has-error' : '' }}">
                                <textarea id="description" name="description" type="text" class="form-control" rows="4" placeholder="Description of the activity" style="color: white;">{{$packageTour->description}}</textarea>
                                @if ($errors->has('description'))
                                    <span class="form-control form-control-danger" style="color: white;">
                                        {{ $errors->first('description') }}
                                    </span>
                                @endif
                            </div>
                            <div class="input-group form-group-no-border input-lg{{ $errors->has('duration') ? ' has-error' : '' }}">
                                <input id="duration" name="duration" type="text" class="form-control" onkeypress="return isNumber(event)" placeholder="Duration in days" style="color: white" value="{{$packageTour->duration}}">
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
                                {!! Form::label('pricing', 'Pricing', ['style'=>'color:white;']) !!}
                            </div>
                            @foreach($packageTour->prices as $price)
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
                                    <input type="button" class="col-sm-4 btn btn-primary btn-round" id="add-media" value="Add Photo Media">
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
                                <div>
                                    {!! Form::label('activity_label', 'Activity associated', ['style'=>'color: white;']) !!}
                                    <div class="row form-group" id="itinerary-form">
                                        {!! Form::label('itinerary_id', 'Activity ', ['class'=>'col-sm-2', 'style'=>'color: white;']) !!}
                                        {!! Form::select('itinerary_id[]', $itineraries, null, ['class'=>'col-sm-8 form-control', 'multiple'=>'multiple']) !!}
                                        <style>
                                            option {
                                                color: white;
                                            }
                                        </style>
                                        <input type="button" class="btn btn-danger btn-round" id="remove-itinerary" value="Remove">
                                    </div>
                                    @foreach($packageTour->itineraries as $itinerary)
                                        <div class="row form-group" id="itinerary-form{{$i}}">
                                            {!! Form::label('itinerary_id', 'Activity ', ['class'=>'col-sm-2', 'style'=>'color: white;']) !!}
                                            {!! Form::select('itinerary_id[]', $itineraries, $itinerary->id, ['class'=>'col-sm-8 form-control', 'multiple'=>'multiple']) !!}
                                            <style>
                                                option {
                                                    color: white;
                                                }
                                            </style>
                                            <input type="button" class="btn btn-danger btn-round" id="remove-itinerary{{$i}}" value="Remove">
                                            <script type="text/javascript">
                                                $(document).ready(function () {
                                                    $("#remove-itinerary" + "<?php echo $i ?>").click(function () {
                                                        $(this).closest("div").remove();
                                                    });
                                                });
                                            </script>
                                        </div>
                                        @php
                                            $i++;
                                        @endphp
                                    @endforeach
                                    <p>
                                        <script type="text/javascript">
                                            $(document).ready(function () {
                                                $("#itinerary-form").hide();
                                                var itineraryFormIndex = "<?php echo $i ?>";
                                                $("#add-itinerary").click(function(){
                                                    itineraryFormIndex++;
                                                    $(this).parent().before($("#itinerary-form").clone().attr("id", "itinerary-form" + itineraryFormIndex));
                                                    $("#itinerary-form" + itineraryFormIndex +" :input").each(function () {
                                                        $(this).attr("name", $(this).attr("name") + itineraryFormIndex);
                                                        $(this).attr("id", $(this).attr("id") + itineraryFormIndex);
                                                    });
                                                    $("#remove-itinerary" + itineraryFormIndex).click(function () {
                                                        $(this).closest("div").remove();
                                                    });
                                                    $("#itinerary-form" + itineraryFormIndex).slideDown();
                                                });
                                            });
                                        </script>
                                    </p>
                                </div>
                        </div>
                        <div class="row footer text-center">
                            <input type="button" class="col-sm-4 btn btn-primary btn-round" id="add-itinerary" value="Add Activity">
                            <button type="submit" class="col-sm-4 btn btn-primary btn-round btn-lg btn-block">Edit Tour Package</button>
                            <button type="button" class="col-sm-4 btn btn-warning btn-round" onclick="location.href='{{route('packagetour.index')}}'">Cancel</button>
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
                    {{--<div class="panel-heading">View Tour Package</div>--}}

                    {{--<div class="panel-body">--}}
                        {{--<div id="myCarousel" class="carousel slide" data-ride="carousel">--}}
                            {{--<!-- Indicators -->--}}
                            {{--<ol class="carousel-indicators">--}}
                                {{--@php--}}
                                    {{--$i = 0;--}}
                                {{--@endphp--}}
                                {{--@foreach($packageTour->medias as $media)--}}
                                    {{--@if($i == 0)--}}
                                        {{--<li data-target="#myCarousel" data-slide-to="{{$i}}" class="active"></li>--}}
                                    {{--@else--}}
                                        {{--<li data-target="#myCarousel" data-slide-to="{{$i}}"></li>--}}
                                    {{--@endif--}}
                                    {{--@php--}}
                                        {{--$i++;--}}
                                    {{--@endphp--}}
                                {{--@endforeach--}}
                            {{--</ol>--}}

                            {{--<!-- Wrapper for slides -->--}}
                            {{--<div class="carousel-inner" role="listbox">--}}
                                {{--@php--}}
                                    {{--$i = 0;--}}
                                {{--@endphp--}}
                                {{--@foreach($packageTour->medias as $media)--}}
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
                        {{--{!! Form::model($packageTour, ['method'=>'PATCH', 'action'=> ['PackageTourController@update', $packageTour->id], 'files' => true]) !!}--}}
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
                                {{--{!! Form::label('duration', 'Duration (in days)') !!}--}}
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
                        {{--@foreach($packageTour->prices as $price)--}}
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
                            {{--<input type="button" class="btn btn-primary" id="add-media" value="Add Photo">--}}
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
                        {{--<div>--}}
                            {{--{!! Form::label('activity_label', 'Activity associated with the tour package') !!}--}}
                            {{--<div class="row form-group" id="itinerary-form">--}}
                                {{--{!! Form::label('itinerary_id', 'Activity ', ['class'=>'col-sm-2']) !!}--}}
                                {{--{!! Form::select('itinerary_id[]', $itineraries, null, ['class'=>'col-sm-8', 'multiple'=>'multiple']) !!}--}}
                                {{--<input type="button" class="btn btn-danger" id="remove-itinerary" value="Remove">--}}
                            {{--</div>--}}
                            {{--@foreach($packageTour->itineraries as $itinerary)--}}
                                {{--<div class="row form-group" id="itinerary-form{{$i}}">--}}
                                    {{--{!! Form::label('itinerary_id', 'Activity ', ['class'=>'col-sm-2']) !!}--}}
                                    {{--{!! Form::select('itinerary_id[]', $itineraries, $itinerary->id, ['class'=>'col-sm-8', 'multiple'=>'multiple']) !!}--}}
                                    {{--<input type="button" class="btn btn-danger" id="remove-itinerary{{$i}}" value="Remove">--}}
                                    {{--<script type="text/javascript">--}}
                                        {{--$(document).ready(function () {--}}
                                            {{--$("#remove-itinerary" + "<?php echo $i ?>").click(function () {--}}
                                                {{--$(this).closest("div").remove();--}}
                                            {{--});--}}
                                        {{--});--}}
                                    {{--</script>--}}
                                {{--</div>--}}
                                {{--@php--}}
                                    {{--$i++;--}}
                                {{--@endphp--}}
                            {{--@endforeach--}}
                            {{--<p>--}}
                                {{--<script type="text/javascript">--}}
                                    {{--$(document).ready(function () {--}}
                                        {{--$("#itinerary-form").hide();--}}
                                        {{--var itineraryFormIndex = "<?php echo $i ?>";--}}
                                        {{--$("#add-itinerary").click(function(){--}}
                                            {{--itineraryFormIndex++;--}}
                                            {{--$(this).parent().before($("#itinerary-form").clone().attr("id", "itinerary-form" + itineraryFormIndex));--}}
                                            {{--$("#itinerary-form" + itineraryFormIndex +" :input").each(function () {--}}
                                                {{--$(this).attr("name", $(this).attr("name") + itineraryFormIndex);--}}
                                                {{--$(this).attr("id", $(this).attr("id") + itineraryFormIndex);--}}
                                            {{--});--}}
                                            {{--$("#remove-itinerary" + itineraryFormIndex).click(function () {--}}
                                                {{--$(this).closest("div").remove();--}}
                                            {{--});--}}
                                            {{--$("#itinerary-form" + itineraryFormIndex).slideDown();--}}
                                        {{--});--}}
                                    {{--});--}}
                                {{--</script>--}}
                            {{--</p>--}}
                        {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<input type="button" class="btn btn-primary" id="add-itinerary" value="Add Activity">--}}
                                {{--{!! Form::submit('Edit Tour Package', ['class'=>'btn btn-primary']) !!}--}}
                                {{--<button type="button" class="btn btn-primary" onclick="location.href='{{route('packagetour.index')}}'">Cancel</button>--}}
                            {{--</div>--}}
                        {{--{!! Form::close() !!}--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
@endsection




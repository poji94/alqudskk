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
        background: url('/preset/backgroundItineraryMoreDarken.png') no-repeat center center fixed;
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
                                                    <img src="{{ $media->path }}" alt="" width="500" height="300">
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
                    <form class="form" method="POST" action="{{url('itinerary/' . $itinerary->id)}}" enctype="multipart/form-data">
                        <input name="_method" type="hidden" value="PATCH">
                        {{ csrf_field() }}
                        <div class="header header-primary text-center">
                            <h3 style="color: white;">Edit {{$itinerary->name}} activity information.</h3>
                        </div>
                        <div class="content">
                            <div class="input-group form-group-no-border input-lg{{ $errors->has('name') ? ' has-error' : '' }}">
                                <input id="name" name="name" type="text" class="form-control" placeholder="Name" style="color: white" value="{{$itinerary->name}}">
                            </div>
                            @if ($errors->has('name'))
                                <span class="badge badge-danger" style="color: white;">
                                        {{ $errors->first('name') }}
                                     </span>
                            @endif
                            <div class="input-group form-group-no-border input-lg{{ $errors->has('description') ? ' has-error' : '' }}">
                                <textarea id="description" name="description" type="text" class="form-control" rows="4" placeholder="Description of the activity" style="color: white;">{{$itinerary->description}}</textarea>
                            </div>
                            @if ($errors->has('description'))
                                <span class="badge badge-danger" style="color: white;">
                                        {{ $errors->first('description') }}
                                    </span>
                            @endif
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
                            </div>
                            @if ($errors->has('duration'))
                                <span class="badge badge-danger" style="color: white;">
                                        {{ $errors->first('duration') }}
                                    </span>
                            @endif
                            <div>
                                <br>
                                {!! Form::label('option1_pickup_label', 'Pick up option 1', ['style'=>'color: white;']) !!}
                            </div>
                            <div class="row">
                                <div class="col-sm-8 input-group form-group-no-border input-lg{{ $errors->has('option1_pickup_place') ? ' has-error' : '' }}">
                                    <input id="option1_pickup_place" name="option1_pickup_place" type="text" class="form-control" placeholder="Pickup place" style="color: white" value="{{$itinerary->option1_pickup_place}}">
                                </div>
                                @if ($errors->has('option1_pickup_place'))
                                    <span class="badge badge-danger" style="color: white;">
                                            {{ $errors->first('option1_pickup_place') }}
                                        </span>
                                @endif
                                <div class="col-sm-4 form-group form-group-no-border input-lg{{ $errors->has('option1_pickup_time') ? ' has-error' : '' }}">
                                    <input id="option1_pickup_time" name="option1_pickup_time" type="time" class="form-control" style="color: white" value="{{$itinerary->option1_pickup_time}}">
                                </div>
                                @if ($errors->has('option1_pickup_time'))
                                    <span class="badge badge-danger" style="color: white;">
                                            {{ $errors->first('option1_pickup_time') }}
                                        </span>
                                @endif
                            </div>
                            <p style="color:white;">Drop off time will be calculated based on pickup time and activity duration</p>
                            <div class="input-group input-group form-group-no-border input-lg{{ $errors->has('option1_dropoff_place') ? ' has-error' : '' }}">
                                <input id="option1_dropoff_place" name="option1_dropoff_place" type="text" class="form-control" placeholder="Drop off place" style="color: white" value="{{$itinerary->option1_dropoff_place}}">
                            </div>
                            @if ($errors->has('option1_dropoff_place'))
                                <span class="badge badge-danger" style="color: white;">
                                        {{ $errors->first('option1_dropoff_place') }}
                                    </span>
                            @endif
                            <div>
                                <br>
                                {!! Form::label('option1_pickup_label', 'Pick up option 2 (optional)', ['style'=>'color: white;']) !!}
                            </div>
                            <div class="row">
                                <div class="col-sm-8 input-group form-group-no-border input-lg{{ $errors->has('option2_pickup_place') ? ' has-error' : '' }}">
                                    <input id="option2_pickup_place" name="option2_pickup_place" type="text" class="form-control" placeholder="Pickup place" style="color: white" value="{{$itinerary->option2_pickup_place}}">
                                </div>
                                @if ($errors->has('option2_pickup_place'))
                                    <span class="badge badge-danger" style="color: white;">
                                            {{ $errors->first('option2_pickup_place') }}
                                        </span>
                                @endif
                                <div class="col-sm-4 form-group form-group-no-border input-lg{{ $errors->has('option2_pickup_time') ? ' has-error' : '' }}">
                                    <input id="option2_pickup_time" name="option2_pickup_time" type="time" class="form-control" style="color: white" value="{{$itinerary->option2_pickup_time}}">
                                </div>
                                @if ($errors->has('option2_pickup_time'))
                                    <span class="badge badge-danger" style="color: white;">
                                            {{ $errors->first('option2_pickup_time') }}
                                        </span>
                                @endif
                            </div>
                            <p style="color:white;">Drop off time will be calculated based on pickup time and activity duration</p>
                            <div class="input-group input-group form-group-no-border input-lg{{ $errors->has('option2_dropoff_place') ? ' has-error' : '' }}">
                                <input id="option2_dropoff_place" name="option2_dropoff_place" type="text" class="form-control" placeholder="Drop off place" style="color: white" value="{{$itinerary->option2_dropoff_place}}">
                            </div>
                            @if ($errors->has('option2_dropoff_place'))
                                <span class="badge badge-danger" style="color: white;">
                                        {{ $errors->first('option2_dropoff_place') }}
                                    </span>
                            @endif
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
                                    </div>
                                    @if ($errors->has('place_tourism'))
                                        <span class="badge badge-danger" style="color: white;">
                                            {{ $errors->first('place_tourism') }}
                                        </span>
                                    @endif
                                @endforeach
                                @foreach($itinerary->types as $type)
                                    <div class="col-sm-6 input-group form-group-no-border input-lg{{ $errors->has('type_vacation') ? ' has-error' : '' }}">
                                        {!! Form::select('type_vacation', [''=>'Choose Tourism Place'] + $typevacation, $type->id, ['class'=>'form-control', 'style'=>'color: white;']) !!}
                                        <style>
                                            option {
                                                color: black;
                                            }
                                        </style>
                                    </div>
                                    @if ($errors->has('type_vacation'))
                                        <span class="badge badge-danger" style="color: white;">
                                        {{ $errors->first('type_vacation') }}
                                    </span>
                                    @endif
                                @endforeach
                            </div>
                            <div>
                                {!! Form::label('pricing', 'Pricing', ['style'=>'color:white;']) !!}
                            </div>
                            @foreach($itinerary->prices as $price)
                                <div class="input-group input-group form-group-no-border input-lg{{ $errors->has('personal') ? ' has-error' : '' }}">
                                    <input id="personal" name="personal" type="number" class="form-control" placeholder="Personal price" style="color: white" value="{{$price->personal}}">
                                </div>
                                @if ($errors->has('personal'))
                                    <span class="badge badge-danger" style="color: white;">
                                            {{ $errors->first('personal') }}
                                        </span>
                                @endif
                                <div class="row">
                                    <div class="col-sm-6 input-group form-group-no-border input-lg{{ $errors->has('private_group_adult') ? ' has-error' : '' }}">
                                        <input id="private_group_adult" name="private_group_adult" type="number" class="form-control" placeholder="Private Group Adult Price" style="color: white" value="{{$price->private_group_adult}}">
                                    </div>
                                    @if ($errors->has('private_group_adult'))
                                        <span class="badge badge-danger" style="color: white;">
                                                {{ $errors->first('private_group_adult') }}
                                            </span>
                                    @endif
                                    <div class="col-sm-6 input-group form-group-no-border input-lg{{ $errors->has('private_group_children') ? ' has-error' : '' }}">
                                        <input id="private_group_children" name="private_group_children" type="number" class="form-control" placeholder="Private Group Children Price" style="color: white" value="{{$price->private_group_children}}">
                                    </div>
                                    @if ($errors->has('private_group_children'))
                                        <span class="badge badge-danger" style="color: white;">
                                                {{ $errors->first('private_group_children') }}
                                            </span>
                                    @endif
                                </div>
                                <div class="row">
                                    <div class="col-sm-6 input-group form-group-no-border input-lg{{ $errors->has('public_group_adult') ? ' has-error' : '' }}">
                                        <input id="public_group_adult" name="public_group_adult" type="number" class="form-control" placeholder="Public Group Adult Price" style="color: white" value="{{$price->public_group_adult}}">
                                    </div>
                                    @if ($errors->has('public_group_adult'))
                                        <span class="badge badge-danger" style="color: white;">
                                                {{ $errors->first('public_group_adult') }}
                                            </span>
                                    @endif
                                    <div class="col-sm-6 input-group form-group-no-border input-lg{{ $errors->has('public_group_children') ? ' has-error' : '' }}">
                                        <input id="public_group_children" name="public_group_children" type="number" class="form-control" placeholder="Public Group Children Price" style="color: white" value="{{$price->public_group_children}}">
                                    </div>
                                    @if ($errors->has('public_group_children'))
                                        <span class="badge badge-danger" style="color: white;">
                                                {{ $errors->first('public_group_children') }}
                                            </span>
                                    @endif
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
@endsection


@extends('layouts.backbone')

@section('head')
    Add Tour Package
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
    login-page
@endsection

@section('titlePage')
    <div class="wrapper">
        <div class="container col-md-8">
            <div class="content-center" style="margin-top: 75px;">
                <div class="card card-plain">
                    <form class="form" method="POST" action="{{url('/packagetour')}}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="header header-primary text-center">
                            <h3 style="color: white;">Please insert new tour package information.</h3>
                        </div>
                        <div class="content">
                            <div class="input-group form-group-no-border input-lg{{ $errors->has('name') ? ' has-error' : '' }}">
                                <input id="name" name="name" type="text" class="form-control" placeholder="Name" style="color: white">
                                @if ($errors->has('name'))
                                    <span class="form-control form-control-danger" style="color: white;">
                                        {{ $errors->first('name') }}
                                     </span>
                                @endif
                            </div>
                            <div class="input-group form-group-no-border input-lg{{ $errors->has('description') ? ' has-error' : '' }}">
                                <textarea id="description" name="description" type="text" class="form-control" rows="4" placeholder="Description of the activity" style="color: white"></textarea>
                                @if ($errors->has('description'))
                                    <span class="form-control form-control-danger" style="color: white;">
                                        {{ $errors->first('description') }}
                                    </span>
                                @endif
                            </div>
                            <div class="input-group form-group-no-border input-lg{{ $errors->has('duration') ? ' has-error' : '' }}">
                                <input id="duration" name="duration" type="text" class="form-control" onkeypress="return isNumber(event)" placeholder="Duration in days" style="color: white">
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
                            <div class="input-group input-group form-group-no-border input-lg{{ $errors->has('personal') ? ' has-error' : '' }}">
                                <input id="personal" name="personal" type="number" class="form-control" placeholder="Personal price" style="color: white">
                                @if ($errors->has('personal'))
                                    <span class="form-control form-control-danger" style="color: white;">
                                    {{ $errors->first('personal') }}
                                </span>
                                @endif
                            </div>
                            <div class="row">
                                <div class="col-sm-6 input-group form-group-no-border input-lg{{ $errors->has('private_group_adult') ? ' has-error' : '' }}">
                                    <input id="private_group_adult" name="private_group_adult" type="number" class="form-control" placeholder="Private Group Adult Price" style="color: white">
                                    @if ($errors->has('private_group_adult'))
                                        <span class="form-control form-control-danger" style="color: white;">
                                            {{ $errors->first('private_group_adult') }}
                                        </span>
                                    @endif
                                </div>
                                <div class="col-sm-6 input-group form-group-no-border input-lg{{ $errors->has('private_group_children') ? ' has-error' : '' }}">
                                    <input id="private_group_children" name="private_group_children" type="number" class="form-control" placeholder="Private Group Children Price" style="color: white">
                                    @if ($errors->has('private_group_children'))
                                        <span class="form-control form-control-danger" style="color: white;">
                                            {{ $errors->first('private_group_children') }}
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6 input-group form-group-no-border input-lg{{ $errors->has('public_group_adult') ? ' has-error' : '' }}">
                                    <input id="public_group_adult" name="public_group_adult" type="number" class="form-control" placeholder="Public Group Adult Price" style="color: white">
                                    @if ($errors->has('public_group_adult'))
                                        <span class="form-control form-control-danger" style="color: white;">
                                            {{ $errors->first('public_group_adult') }}
                                        </span>
                                    @endif
                                </div>
                                <div class="col-sm-6 input-group form-group-no-border input-lg{{ $errors->has('public_group_children') ? ' has-error' : '' }}">
                                    <input id="public_group_children" name="public_group_children" type="number" class="form-control" placeholder="Public Group Children Price" style="color: white">
                                    @if ($errors->has('public_group_children'))
                                        <span class="form-control form-control-danger" style="color: white;">
                                            {{ $errors->first('public_group_children') }}
                                        </span>
                                    @endif
                                </div>
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
                                <p>
                                    <script type="text/javascript">
                                        $(document).ready(function () {
                                            $("#itinerary-form").hide();
                                            var itineraryFormIndex = 0;
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
                            <button type="submit" class="col-sm-4 btn btn-primary btn-round btn-lg btn-block">Add Tour Package</button>
                            <button type="button" class="col-sm-4 btn btn-warning btn-round" onclick="location.href='{{route('packagetour.index')}}'">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

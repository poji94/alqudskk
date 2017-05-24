@extends('layouts.app')

@section('head')
    Add Tour Package
@endsection

@section('content')
    <div class="container" style="padding-top: 75px">
        <div class="row">
            <div class="col-sm-6 col-md-offset-3">
                <div class="panel panel-default">
                    <div class="panel-heading">Add Tour Package</div>

                    <div class="panel-body">
                        {!! Form::open(['method'=>'POST', 'action'=> 'PackageTourController@store', 'files' => true]) !!}
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            {!! Form::label('name', 'Name') !!}
                            {!! Form::text('name', null, ['class'=>'form-control']) !!}
                            @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                            {!! Form::label('description', 'Description') !!}
                            {!! Form::textarea('description', null, ['class'=>'form-control', 'rows'=>'4']) !!}
                            @if ($errors->has('description'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('description') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('duration') ? ' has-error' : '' }}">
                            {!! Form::label('duration', 'Duration') !!}
                            {!! Form::text('duration', null, ['class'=>'form-control']) !!}
                            @if ($errors->has('duration'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('duration') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div>
                            {!! Form::label('personal', 'Personal price') !!}
                        </div>
                        <div class="row">
                            <div class="col-sm-6 form-group{{ $errors->has('personal') ? ' has-error' : '' }}">
                                {!! Form::label('personal', 'Per adult') !!}
                                {!! Form::number('personal', null, ['class'=>'form-control']) !!}
                                @if ($errors->has('personal'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('personal') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div>
                            {!! Form::label('private_group', 'Private group price') !!}
                        </div>
                        <div class="row">
                            <div class="col-sm-6 form-group{{ $errors->has('private_group_adult') ? ' has-error' : '' }}">
                                {!! Form::label('private_group_adult', 'Per adult') !!}
                                {!! Form::number('private_group_adult', null, ['class'=>'form-control']) !!}
                                @if ($errors->has('private_group_adult'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('private_group_adult') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-sm-6 form-group{{ $errors->has('private_group_children') ? ' has-error' : '' }}">
                                {!! Form::label('private_group_children', 'Per child') !!}
                                {!! Form::number('private_group_children', null, ['class'=>'form-control']) !!}
                                @if ($errors->has('private_group_children'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('private_group_children') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div>
                            {!! Form::label('public_group', 'Public group price') !!}
                        </div>
                        <div class="row">
                            <div class="col-sm-6 form-group{{ $errors->has('public_group_adult') ? ' has-error' : '' }}">
                                {!! Form::label('public_group_adult', 'Per adult') !!}
                                {!! Form::number('public_group_adult', null, ['class'=>'form-control']) !!}
                                @if ($errors->has('public_group_adult'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('public_group_adult') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-sm-6 form-group{{ $errors->has('public_group_children') ? ' has-error' : '' }}">
                                {!! Form::label('public_group_children', 'Per child') !!}
                                {!! Form::number('public_group_children', null, ['class'=>'form-control']) !!}
                                @if ($errors->has('public_group_children'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('public_group_children') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div>
                            {!! Form::label('media_id', 'Media') !!}
                            <div class="form-group" id="media-form">
                                {!! Form::file('media_id_reference', array('multiple'=>'multiple', 'accept'=>'image/*', 'class'=>'btn btn-primary col-sm-10')) !!}
                                <input type="button" class="btn btn-danger" id="remove-media" value="Remove" >
                            </div>
                        </div>
                        <p>
                            <input type="button" class="btn btn-primary" id="add-media" value="Add Photo">
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
                            {!! Form::label('activity_label', 'Activity associated with the tour package') !!}
                            <div class="row form-group" id="itinerary-form">
                                {!! Form::label('itinerary_id', 'Activity ', ['class'=>'col-sm-2']) !!}
                                {!! Form::select('itinerary_id[]', $itineraries, null, ['class'=>'col-sm-8', 'multiple'=>'multiple']) !!}
                                <input type="button" class="btn btn-danger" id="remove-itinerary" value="Remove">
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

                        <div class="form-group">
                            <input type="button" class="btn btn-primary" id="add-itinerary" value="Add Activity">
                            {!! Form::submit('Create Tour Package', ['class'=>'btn btn-primary']) !!}
                            <button type="button" class="btn btn-primary" onclick="location.href='{{route('packagetour.index')}}'">Cancel</button>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@extends('layouts.app')

@section('head')
    View Activity
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
            <div class="col-sm-6 col-md-offset-3">
                <div class="panel panel-default">
                    <div class="panel-heading">View Activity</div>

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
                                        <img src="{{ $media->path }}" alt="" width="460" height="345">
                                    </div>
                                @else
                                    <div class="item">
                                        <img src="{{ $media->path }}" alt="" width="460" height="345">
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

                    <div class="panel-body">
                        {!! Form::model($itinerary, ['method'=>'PATCH', 'action'=> ['ItineraryController@update', $itinerary->id], 'files' => true]) !!}
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
                            {!! Form::label('option1_pickup_label', 'Pick up option 1') !!}
                        </div>
                        <div class="row">
                            <div class="col-sm-8 form-group{{ $errors->has('option1_pickup_place') ? ' has-error' : '' }}">
                                {!! Form::label('option1_pickup_place_label', 'Place') !!}
                                {!! Form::text('option1_pickup_place', null, ['class'=>'form-control']) !!}
                                @if ($errors->has('option1_pickup_place'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('option1_pickup_place') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-sm-4 form-group{{ $errors->has('option1_pickup_time') ? ' has-error' : '' }}">
                                {!! Form::label('option1_pickup_time_label', 'Time') !!}
                                {!! Form::time('option1_pickup_time', null, ['class'=>'form-control']) !!}
                                @if ($errors->has('option1_pickup_time'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('option1_pickup_time') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div>
                            {!! Form::label('option1_dropoff_label', 'Drop off option 1') !!}
                        </div>
                        <div class="form-group{{ $errors->has('option1_dropoff_place') ? ' has-error' : '' }}">
                            {!! Form::label('option1_dropoff_place_label', 'Place') !!}
                            {!! Form::text('option1_dropoff_place', null, ['class'=>'form-control']) !!}
                            @if ($errors->has('option1_dropoff_place'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('option1_dropoff_place') }}</strong>
                                </span>
                            @endif
                            Drop off time will be calculated based on pickup time and activity duration
                        </div>
                        <div>
                            {!! Form::label('option2_pickup_label', 'Pick up option 2 (optional)') !!}
                        </div>
                        <div class="row">
                            <div class="col-sm-8 form-group{{ $errors->has('option2_pickup_place') ? ' has-error' : '' }}">
                                {!! Form::label('option2_pickup_place_label', 'Place') !!}
                                {!! Form::text('option2_pickup_place', null, ['class'=>'form-control']) !!}
                                @if ($errors->has('option2_pickup_place'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('option2_pickup_place') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-sm-4 form-group{{ $errors->has('option2_pickup_time') ? ' has-error' : '' }}">
                                {!! Form::label('option2_pickup_time_label', 'Time') !!}
                                {!! Form::time('option2_pickup_time', null, ['class'=>'form-control']) !!}
                                @if ($errors->has('option2_pickup_time'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('option2_pickup_time') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div>
                            {!! Form::label('option2_dropoff_label', 'Drop off option 2') !!}
                        </div>
                        <div class="form-group{{ $errors->has('option2_dropoff_place') ? ' has-error' : '' }}">
                            {!! Form::label('option2_dropoff_place_label', 'Place') !!}
                            {!! Form::text('option2_dropoff_place', null, ['class'=>'form-control']) !!}
                            @if ($errors->has('option2_dropoff_place'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('option2_dropoff_place') }}</strong>
                                </span>
                            @endif
                            Drop off time will be calculated based on pickup time and activity duration
                        </div>
                        <div class="row">
                            @foreach($itinerary->places as $place)
                                <div class="col-sm-6 form-group{{ $errors->has('place_tourism') ? ' has-error' : '' }}">
                                    {!! Form::label('place_tourism','Location') !!}
                                    {!! Form::select('place_tourism', [''=>'Choose Options'] + $placetourism, $place->id, ['class'=>'form-control']) !!}
                                    @if ($errors->has('place_tourism'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('place_tourism') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            @endforeach
                            @foreach($itinerary->types as $type)
                                <div class="col-sm-6 form-group{{ $errors->has('type_vacation') ? ' has-error' : '' }}">
                                    {!! Form::label('type_vacation','Type of vacation') !!}
                                    {!! Form::select('type_vacation', [''=>'Choose Options'] + $typevacation, $type->id, ['class'=>'form-control']) !!}
                                    @if ($errors->has('type_vacation'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('type_vacation') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                        @foreach($itinerary->prices as $price)
                            <div>
                                {!! Form::label('personal', 'Personal price') !!}
                            </div>
                            <div class="row">
                                <div class="col-sm-6 form-group{{ $errors->has('personal') ? ' has-error' : '' }}">
                                    {!! Form::label('personal', 'Price per adult') !!}
                                    {!! Form::number('personal', $price->personal, ['class'=>'form-control']) !!}
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
                                    {!! Form::label('private_group_adult', 'Price per adult') !!}
                                    {!! Form::number('private_group_adult', $price->private_group_adult, ['class'=>'form-control']) !!}
                                    @if ($errors->has('private_group_adult'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('private_group_adult') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="col-sm-6 form-group{{ $errors->has('private_group_children') ? ' has-error' : '' }}">
                                    {!! Form::label('private_group_children', 'Price per child') !!}
                                    {!! Form::number('private_group_children', $price->private_group_children, ['class'=>'form-control']) !!}
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
                                    {!! Form::label('public_group_adult', 'Price per adult') !!}
                                    {!! Form::number('public_group_adult', $price->public_group_adult, ['class'=>'form-control']) !!}
                                    @if ($errors->has('public_group_adult'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('public_group_adult') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="col-sm-6 form-group{{ $errors->has('public_group_children') ? ' has-error' : '' }}">
                                    {!! Form::label('public_group_children', 'Price per child') !!}
                                    {!! Form::number('public_group_children', $price->public_group_children, ['class'=>'form-control']) !!}
                                    @if ($errors->has('public_group_children'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('public_group_children') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                        <div>
                            {!! Form::label('media_id', 'Media') !!}
                            <div class="form-group" id="media-form">
                                {!! Form::file('media_id_reference', array('multiple'=>'multiple', 'accept'=>'image/*', 'class'=>'btn btn-primary col-sm-10')) !!}
                                <input type="button" class="btn btn-danger" id="remove-media" value="Remove" >
                            </div>
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

                        <div class="form-group">
                            <input type="button" class="btn btn-primary" id="add-media" value="Add Photo">
                            {!! Form::submit('Edit Activity', ['class'=>'btn btn-primary']) !!}
                            <button type="button" class="btn btn-primary" onclick="location.href='{{route('itinerary.index')}}'">Cancel</button>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


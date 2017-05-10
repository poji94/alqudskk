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
                            {!! Form::text('name', null, ['class'=>'form-control', 'readonly']) !!}
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
                        <div class="row">
                            <div class="col-sm-6 form-group{{ $errors->has('place_tourism') ? ' has-error' : '' }}">
                                {!! Form::label('place_tourism','Location') !!}
                                {!! Form::select('place_tourism', [''=>'Choose Options'] + $placetourism, $place_tourism, ['class'=>'form-control']) !!}
                                @if ($errors->has('place_tourism'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('place_tourism') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-sm-6 form-group{{ $errors->has('type_vacation') ? ' has-error' : '' }}">
                                {!! Form::label('type_vacation','Type of vacation') !!}
                                {!! Form::select('type_vacation', [''=>'Choose Options'] + $typevacation, $type_vacation, ['class'=>'form-control']) !!}
                                @if ($errors->has('type_vacation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('type_vacation') }}</strong>
                                    </span>
                                @endif
                            </div>
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
                        <div class="row">
                            <div class="col-sm-6 form-group{{ $errors->has('price_children') ? ' has-error' : '' }}">
                                {!! Form::label('price_children', 'Price per child') !!}
                                {!! Form::number('price_children', null, ['class'=>'form-control']) !!}
                                @if ($errors->has('price_children'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('price_children') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-sm-6 form-group{{ $errors->has('price_adult') ? ' has-error' : '' }}">
                                {!! Form::label('price_adult', 'Price per adult') !!}
                                {!! Form::number('price_adult', null, ['class'=>'form-control']) !!}
                                @if ($errors->has('price_adult'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('price_adult') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        {!! Form::label('media_id', 'Media') !!}
                        <div class="form-group" id="media-form">
                            {!! Form::file('media_id_reference', array('multiple'=>'multiple', 'accept'=>'image/*', 'class'=>'btn btn-primary col-sm-10')) !!}
                            <input type="button" class="btn btn-danger" id="remove-media" value="Remove" >
                        </div>
                        <p>
                            <input type="button" class="btn btn-primary" id="add-media" value="Add Media">
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

                        </p>
                        <div class="form-group">
                            {!! Form::submit('Edit Activity', ['class'=>'btn btn-primary']) !!}
                        </div>
                        {!! Form::close() !!}

                        <button type="button" class="btn btn-primary" onclick="location.href='{{route('itinerary.index')}}'">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


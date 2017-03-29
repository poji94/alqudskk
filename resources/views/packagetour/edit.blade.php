@extends('layouts.app')

@section('head')
    View Tour Package
@endsection

@section('content')
    <div class="container" style="padding-top: 5%">
        <div class="row">
            <div class="col-sm-6 col-md-offset-3">
                <div class="panel panel-default">
                    <div class="panel-heading">View Tour Package</div>

                    <div class="panel-body">
                        {!! Form::model($packagetour, ['method'=>'PATCH', 'action'=> ['PackageTourController@update', $packagetour->id], 'files' => true]) !!}
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
                            <div class="row form-group" id="itinerary-form">
                                {!! Form::label('itinerary_id', 'Itinerary', ['class'=>'col-sm-2']) !!}
                                {!! Form::select('itinerary_id[]', $itineraries, null, ['class'=>'col-sm-4', 'multiple'=>'multiple']) !!}
                                <input type="button" class="col-sm-2 btn btn-danger" id="remove-itinerary" value="Remove">
                            </div>
                            @foreach($packagetour->itineraries as $itinerary)
                                <div class="row form-group" id="itinerary-form{{$i}}">
                                    {!! Form::label('itinerary_id', 'Itinerary', ['class'=>'col-sm-2']) !!}
                                    {!! Form::select('itinerary_id[]', $itineraries, $itinerary->id, ['class'=>'col-sm-4', 'multiple'=>'multiple']) !!}
                                    <input type="button" class="col-sm-2 btn btn-danger" id="remove-itinerary{{$i}}" value="Remove">
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
                                <input type="button" class="btn btn-primary" id="add-itinerary" value="Add Itinerary">
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
                            <div class="form-group">
                                {!! Form::submit('Edit Tour Package', ['class'=>'btn btn-primary']) !!}
                            </div>
                        {!! Form::close() !!}
                        <div class="form-group">
                            {!!  Form::open(['method' => 'DELETE', 'action' => ['PackageTourController@destroy', $packagetour->id]])!!}
                            {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                            {!! Form::close() !!}
                        </div>
                        <button type="button" class="btn btn-primary" onclick="location.href='{{route('packagetour.index')}}'">Cancel</button>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection




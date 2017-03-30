@extends('layouts.app')

@section('head')
    Vacations
@endsection

@section('content')
    <div class="container" style="padding-top: 75px">
        <div class="row">
            <div class="col-sm-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Vacation selection</div>

                    <div class="panel-body">
                        Please choose your selection
                        @if(url()->current() == 'http://alqudskk.com/itinerarySelection')
                            {!! Form::open(['method'=>'GET', 'action'=> 'ItineraryController@getSelection']) !!}
                        @else
                            {!! Form::open(['method'=>'POST', 'action'=> 'ItineraryController@store']) !!}
                        @endif
                            <div class="row">
                                <div class="col-sm-6 form-group">
                                    {!! Form::label('place_tourism','Location') !!}
                                    {!! Form::select('place_tourism', [''=>'Choose Options'] + $placetourism, null, ['class'=>'form-control']) !!}
                                </div>
                                <div class="col-sm-6 form-group">
                                    {!! Form::label('type_vacation','Type of vacation') !!}
                                    {!! Form::select('type_vacation', [''=>'Choose Options'] + $typevacation, null, ['class'=>'form-control']) !!}
                                </div>
                                <div class="col-sm-2 form-group">
                                    {!! Form::submit('Submit', ['class'=>'btn btn-primary']) !!}
                                </div>
                            </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
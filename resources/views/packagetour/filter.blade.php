@extends('layouts.app')

@section('head')
    Itineraries
@endsection

@section('content')
    <div class="container" style="padding-top: 75px">
        <div class="row">
            <div class="col-sm-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Itinerary selection</div>

                    <div class="panel-body">
                        Please choose your selection
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
    <div class="container">
        <div class="row">
            <div class="col-sm-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">List of tour packages</div>
                    <div class="panel-body">
                        @if($selectedPackageTours)
                            @foreach($selectedPackageTours as $selectedPackageTour)
                                <div class="page-header">
                                    Name: {{ $selectedPackageTour->name }} <br>
                                    Duration: {{ $selectedPackageTour->duration }} <br>
                                    Price per Adult: {{ $selectedPackageTour->price_adult }} <br>
                                    Price per Child: {{ $selectedPackageTour->price_children }} <br>
                                    <button type="button" class="btn btn-primary" onclick="location.href='{{route('packagetour.show', $selectedPackageTour->id)}}'">View</button>
                                    <button type="button" class="btn btn-primary" onclick="location.href='{{url('/login')}}'">Book Now</button>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
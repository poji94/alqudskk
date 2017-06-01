@extends('layouts.backbone')

@section('head')
    Tour Packages
@endsection

@section('style')
    body {
    background: url('/preset/backgroundPackageTourDarken.jpg') no-repeat center center fixed;
    -webkit-background-size: cover;
    -moz-background-size: cover;
    -o-background-size: cover;
    background-size: cover;
    }
@endsection

@section('bodyClass')
    index-page
@endsection

@section('content')
    <div class="section" id="backgroundUser" data-parallax="true" style="background-image:url('/preset/backgroundPackageTourDarken.jpg'); background-size: 100% 100%; background-repeat: no-repeat; height: 100vh;">
        <div class="container" style="margin-top: 30px;">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="card " style="height: 75vh;">
                        <br>
                        <h3 class="category" style="color: black; text-align: center;">Tour Package Management</h3>
                        <p class="category" style="color: black; text-align: center;">List of stored tour packages.</p>
                        <br>
                        <div class="card-block" style="height: 55vh; overflow:scroll;">
                            <div class="responsive-table">
                                <table class="table">
                                    <thead style="background-color: #9c27b0; color:white;">
                                    <tr>
                                        <th>ID</th>
                                        <th width="35%">Name</th>
                                        <th>Created</th>
                                        <th>Updated</th>
                                        <th colspan="2">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if($packagetours)
                                        @foreach($packagetours as $packagetour)
                                            <tr>
                                                <td>{{$packagetour->id}}</td>
                                                <td>{{$packagetour->name}}</td>
                                                <td>{{$packagetour->created_at->diffForHumans()}}</td>
                                                <td>{{$packagetour->updated_at->diffForHumans()}}</td>
                                                <td><button type="button" class="btn btn-primary btn-round" onclick="location.href='{{route('packagetour.edit', $packagetour->id)}}'">View</button></td>
                                                <td><button type="button" class="btn btn-danger btn-round" data-toggle="modal" data-target="#{{$packagetour->id}}">Delete</button></td>
                                                <div class="modal fade" id="{{$packagetour->id}}" role="dialog">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header justify-content-center">
                                                                <h4 class="modal-title">Delete tour package confirmation</h4>
                                                            </div>
                                                            <div class="modal-body text-center">
                                                                Tour package {{$packagetour->name}} will be deleted. Continue?
                                                            </div>
                                                            <div class="modal-footer justify-content-center">
                                                                {!!  Form::open(['method' => 'DELETE', 'action' => ['PackageTourController@destroy', $packagetour->id]])!!}
                                                                {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-danger btn-round']) !!}
                                                                {!! Form::close() !!}
                                                                <button type="button" class="btn btn-primary btn-round" data-dismiss="modal">Cancel</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </tr>
                                        @endforeach
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                            <button type="button" class="btn btn-primary btn-round" onclick="location.href='{{route('packagetour.create')}}'">Create</button>
                        </div>
                        <div class="tab-content text-center">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if(Session::has('created_packagetour'))
        <script type="text/javascript">
            $(window).on('load',function(){
                $('#created_packagetour').modal('show');
            });
        </script>
        <div class="modal fade" id="created_packagetour" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header justify-content-center">
                        <h4 class="modal-title">Tour package created</h4>
                    </div>
                    <div class="modal-body text-center">
                        {{session('created_packagetour')}}
                    </div>
                    <div class="modal-footer justify-content-center">
                        <button type="button" class="btn btn-primary btn-round" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    @endif
    @if(Session::has('updated_packagetour'))
        <script type="text/javascript">
            $(window).on('load',function(){
                $('#updated_packagetour').modal('show');
            });
        </script>
        <div class="modal fade" id="updated_packagetour" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header justify-content-center">
                        <h4 class="modal-title">Tour package updated</h4>
                    </div>
                    <div class="modal-body text-center">
                        {{session('updated_packagetour')}}
                    </div>
                    <div class="modal-footer justify-content-center">
                        <button type="button" class="btn btn-primary btn-round" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    @endif
    @if(Session::has('deleted_packagetour'))
        <script type="text/javascript">
            $(window).on('load',function(){
                $('#deleted_packagetour').modal('show');
            });
        </script>
        <div class="modal fade" id="deleted_packagetour" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header justify-content-center">
                        <h4 class="modal-title">Tour package deleted</h4>
                    </div>
                    <div class="modal-body text-center">
                        {{session('deleted_packagetour')}}
                    </div>
                    <div class="modal-footer justify-content-center">
                        <button type="button" class="btn btn-primary btn-round" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection


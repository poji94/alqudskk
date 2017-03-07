@extends('layouts.master')

{!! Form::open(['method'=>'POST', 'action'=> 'UserController@store', 'files' => true]) !!}
<div class="form-group">
    {!! Form::label('name', 'Name') !!}
    {!! Form::text('name', null, ['class'=>'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('email', 'Email') !!}
    {!! Form::email('email', null, ['class'=>'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('password', 'Password') !!}
    {!! Form::password('password', ['class'=>'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('password_confirmation', 'Confirm Password') !!}
    {!! Form::password('password_confirmation', ['class'=>'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('role_user_id', 'Role User') !!}
    {!! Form::select('role_user_id', [''=>'Choose Options'] + $roleUser, null, ['class'=>'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('phone_number', 'Phone Number') !!}
    {!! Form::text('phone_number', null, ['class'=>'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::submit('Create User', ['class'=>'btn btn-primary']) !!}
</div>
{!! Form::close() !!}

@include('includes.form_error')
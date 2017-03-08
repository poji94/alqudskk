@extends('layouts.master')

<h1>Users</h1>
<table class="table">
    <thead>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Role User</th>
        <th>Phone Number</th>
        <th>Created</th>
        <th>Updated</th>
        <th colspan="2">Action</th>
    </tr>
    </thead>
    <tbody>
    @if($users)
        @foreach($users as $user)
            <tr>
                <td>{{$user->id}}</td>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td>{{$user->roleUser->name}}</td>
                <td>{{$user->phone_number}}</td>
                <td>{{$user->created_at->diffForHumans()}}</td>
                <td>{{$user->updated_at->diffForHumans()}}</td>
                <td><button type="button" onclick="location.href='{{route('user.edit', $user->id)}}'">Edit</button></td>
                <td><button type="button" onclick="location.href='{{route('user.destroy', $user->id)}}'">Delete</button></td>
            </tr>
        @endforeach
    @endif
    </tbody>
</table>
<button type="button" onclick="location.href='{{route('user.create')}}'">Create</button>
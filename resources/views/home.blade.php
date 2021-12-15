@extends('layouts.app')

@section('title', 'Homepage')

@section('content')
@if(Gate::allows('isAdmin'))
    <p><a href = "{{route('admin.posts.create')}}">Create Post</a></p>
    <p><a href = "{{route('admin.users.create')}}">Create User</a></P>
@else
    <p><a href = "{{route('user.posts.create')}}">Create Post</a></p>
@endif
@endsection
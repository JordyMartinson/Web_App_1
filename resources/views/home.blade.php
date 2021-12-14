@extends('layouts.app')

@section('title', 'Homepage')

@section('content')
@if(Gate::allows('isAdmin'))
    <a href = "{{route('admin.posts.create')}}">Create Post</a>
    <a href = "{{route('admin.posts.create')}}">Create User</a>
@else
    <a href = "{{route('user.posts.create')}}">Create Post</a>
@endif
@endsection
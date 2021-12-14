@extends('layouts.app')

@section('title')
    Homepage


@endsection

@section('content')
    <a href = "{{route('admin.posts.create')}}">Create Post</a>
    <br>
    <a href = "/comments/create">Create Comment</a>
@endsection
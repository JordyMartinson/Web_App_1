@extends('layouts.app')

@section('title')
    Homepage


@endsection

@section('content')
    <a href = "{{route('posts.create')}}">Create Post</a>
    <br>
    <a href = "{{route('comments.create')}}">Create Comment</a>
@endsection
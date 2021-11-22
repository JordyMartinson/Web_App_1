@extends('layouts.app')

@section('title')
    Posts
@endsection

@section('content')

    <p>Posts from users: </p>

    <ul>
        @foreach ($posts as $post)
            <li><a href="/posts/{{$post->id}}">{{$post -> title}}</a></li>
        @endforeach
    </ul>

@endsection
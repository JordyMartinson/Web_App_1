@extends('layouts.app')

@section('title')
    Comments
@endsection

@section('content')

    <p>Comments from users: </p>

    <ul>

            @foreach ($comments as $comment)
            <li><a href="/comments/{{$comment->id}}">{{$comment -> user -> name}}: {{$comment -> content}}</a></li>
            @endforeach

    </ul>

    <a href = "{{route('comments.create')}}">Create Comment</a>

@endsection
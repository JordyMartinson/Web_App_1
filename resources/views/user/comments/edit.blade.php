@extends('layouts.app')

@section('title', 'Edit Comment')

@section('content')

<form method="POST" action = "{{route('user.comments.update', ['comment' => $comment])}}">
    @method('PUT')
    @csrf

    <div>
        <label>Post: {{$comment->post->title}}</label>
    </div>
    <div>
        <label>Posted by: {{$comment->post->user->name}}</label>
    </div>
    <div>
        <label>Your comment: </label>
        <input type = "text" name = "content" id="content" value = "{{ $comment -> content }}" placeholder = "Enter your comment here"></p>
    </div>
    <button class="btn" type = "submit">Submit</button>
</form>

@endsection

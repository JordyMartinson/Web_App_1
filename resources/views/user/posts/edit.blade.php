@extends('layouts.app')

@section('title', 'Edit Post')

@section('content')

<form method="POST" action = "{{route('user.posts.update', ['post' => $post])}}">
    @method('PUT')
    @csrf

    <div>
        <label>Title: </label>
        <input type = "text" name = "title" id="title" value = "{{ $post -> title }}" placeholder = "Enter your title here"></p>
    </div>
    <div>
        <label>Content: </label>
        <input type = "text" name = "content" id="content" value = "{{ $post -> content }}" placeholder = "Enter your content here"></p>
    </div>
    <button class="btn" type = "submit">Submit</button>
</form>

@endsection

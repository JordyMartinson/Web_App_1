@extends('layouts.app')

@section('title', 'Comment')

@section('content')

    <form method = "POST" action = "{{route('comments.store')}}">
        @csrf
        <p>Content: <input type = "text" name = "content"></p>

        <p>
            <label for="user_id">User: </label>
            <select name="user_id">
                @foreach ($users as $user)
                    <option value="{{$user -> id}}">{{$user -> name}}</option>
                @endforeach
            </select>
        </p>

        <p>
            <label for="post_id">Post: </label>
            <select name="post_id">
                @foreach ($posts as $post)
                    <option value="{{$post -> id}}">{{$post -> title}}</option>
                @endforeach
            </select>
        </p>

        <input type = "submit" value = "Submit">
        <a href = "{{route('comments.index')}}">Cancel</a>
    </form>

@endsection
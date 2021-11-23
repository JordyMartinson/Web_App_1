@extends('layouts.app')

@section('title', 'Create Post')

@section('content')

    <form method = "POST" action = "{{route('posts.store')}}">
        @csrf
        <p>Title: <input type = "text" name = "title"></p>
        <p>Content: <input type = "text" name = "content"></p>
        <p>
            <label for="user_id">User: </label>
            <select name="user_id">
                <option value="{{$user -> id}}">{{$user -> name}}</option>
                {{-- <option value="1">1</option> --}}
            </select>
        </p>
        <input type = "submit" value = "Submit">
        <a href = "{{route('posts.index')}}">Cancel</a>
    </form>

@endsection
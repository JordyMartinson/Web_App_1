@extends('layouts.app')

@section('title', 'Post Details')

@section('content')
        
    <ul>
        <li>Content: {{$post -> content}}</li>
        <li>Poster: {{$post -> user -> name}}</li>
        <br>



        @php ($count = $post -> comments() -> count())
        @if ($count > 0)
            @for ($i = 0; $i < $count; $i++)
            <li>Comment: {{$post -> comments[$i] -> content}}</li>
            <li>Comment Poster: {{$post -> comments[$i] -> user -> name}}</li>
            <br>
            @endfor
        @endif
    </ul>

@endsection

@section('commenting')
    <form>
        <label for = "comment"> Comment: </label><br>
        <input type = "text" id = "comment" name = "comment"><br>
        <input type = "submit" value = "Submit"><br><br>
    </form>
@endsection
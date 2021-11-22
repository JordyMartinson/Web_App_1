@extends('layouts.app')

@section('title', 'Post Details')

@section('content')
        
    <ul>
        <h2><b>{{$post -> title}}</b></h2>
        <p>{{$post -> content}}</p>
        <p>Poster: {{$post -> user -> name}}</p>
        <br>

        @php ($count = $post -> comments() -> count())
        @if ($count > 0)
            @for ($i = 0; $i < $count; $i++)
            <p>{{$post -> comments[$i] -> content}}<br>
            From {{$post -> comments[$i] -> user -> name}}</p>
            @endfor
        @endif
    </ul>

@endsection

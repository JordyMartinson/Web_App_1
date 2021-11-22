@extends('layouts.app')

@section('title', 'Comment Details')

@section('content')
        
    <ul>
        <p>On the post "{{$comment -> post -> title}}"</p>
        <p>{{$comment -> content}}</p>
        <p>{{$comment -> user -> name}}</p>
        <br>

        {{-- @php ($count = $post -> comments() -> count())
        @if ($count > 0)
            @for ($i = 0; $i < $count; $i++)
            <p>{{$post -> comments[$i] -> content}}<br>
            From {{$post -> comments[$i] -> user -> name}}</p>
            @endfor
        @endif --}}
    </ul>

@endsection

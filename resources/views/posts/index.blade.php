@extends('layouts.app')

@section('title')
    Posts
@endsection

@section('content')

    <p>Posts from users: </p>

    <ul>
        @foreach ($posts as $post)
            <li> {{$post -> content}} </li>
        @endforeach
    </ul>

@endsection
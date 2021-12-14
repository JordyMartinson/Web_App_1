@extends('layouts.app')

@section('title', 'Users')

@section('content')

    <p>Users: </p>

    <p>
        @foreach ($users as $user)
            <li> {{$user -> name}} </li>
        @endforeach
    </p>

@endsection
@extends('layouts.app')

@section('title', 'Post Details')

@section('content')
        
    <ul>
        <li>Content: {{$post -> content}}</li>
        <li>User Id: {{$post -> user_id}}</li>
        {{-- <li>Comments: {{$post -> comments()}}</li> --}}
    </ul>

@endsection
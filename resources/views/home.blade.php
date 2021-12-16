@extends('layouts.app')

@section('title', 'Homepage')

@section('content')

    @if(Gate::allows('isAdmin'))
        <p><a class="btn" href = "{{route('admin.posts.create')}}" role = "button">Create Post</button></p>
        <p><a class="btn" href = "{{route('admin.users.create')}}" role = "button">Create User</button></p>
    @elseif(Gate::allows('isUser'))
        <p><a class="btn" href = "{{route('user.posts.create')}}" role = "button">Create Post</button></p>
    @endif

@endsection
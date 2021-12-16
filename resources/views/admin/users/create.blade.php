@extends('layouts.app')

@section('title', 'Create New User')

@section('content')

<form method="POST" action = "{{route('admin.users.store')}}">
    @csrf
    <div>
        <label>Name</label>
        <input type="text" name = "name">
    </div>
    <div>
        <label>Email Address</label>
        <input type="email" name = "email">
    </div>
    <div>
        <label>Password</label>
        <input type="password" name = "password">
    </div>
    <div>
        @foreach ($roles as $role)
        <div class = "form-check">
            <input class = "form-check-input" name="roles[]" type ="checkbox" value="{{ $role->id }}" id="{{$role->name}}">
            <label for="{{$role->name}}">{{$role->name}}</label>
        </div>
        @endforeach
    </div>
    <button class="btn" type = "submit">Submit</button>
</form>

@endsection

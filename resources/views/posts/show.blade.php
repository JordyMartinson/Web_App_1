@extends('layouts.app')

@section('title', 'Post Details')

@section('content')
        
    <ul>
        <h2><b>{{$post -> title}}</b></h2>
        <p>{{$post -> content}}</p>
        <p>Poster: {{$post -> user -> name}}</p>
        <br>



        <form method = "POST" action = "{{route('comments.store')}}">
            @csrf
            <p>Content: <input type = "text" name = "content" onfocus ="this.value = ''" value = "Enter your comment here"></p>
    
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
                    <option value="{{$post -> id}}">{{$post -> title}}</option>
                </select>
            </p>
    
            <input type = "submit" value = "Submit">
            <input type = "reset" value = "Cancel">
            {{-- <a href = "{{route('posts.index')}}" onclick="document.getElementById('content').value =">Cancel</a> --}}
        </form>



        @php ($count = $post -> comments() -> count())
        @if ($count > 0)
            @for ($i = 0; $i < $count; $i++)
                <p>{{$post -> comments[$i] -> content}}<br>
                From {{$post -> comments[$i] -> user -> name}}</p>
            @endfor
        @endif
    </ul>

@endsection

@extends('layouts.app')

@section('title', 'Edit Post')

@section('content')

<form method = "POST" action = "{{route('posts.update', ['post' => $post])}}">
    @csrf
    {{-- <p>Content: <input type = "text" name = "content" id="content" value = {{ $comment-> content }} placeholder = "Enter your comment here"></p> --}}
    
        <p>
        <label for="title">Title: </label>
        <textarea name = "title"> {{ $post-> title }}</textarea>
        </p>
    <p>
        <label for="content">Content: </label>
        <textarea name = "content"> {{ $post-> content }}</textarea>
    </p>

    <p>
        <label for="user_id">User: </label>
        {{-- <select name="post_id">
            @foreach ($posts as $post)
                <option value="{{$post -> id}}"
                    @if ($post->id == old('post_id'))
                        selected = "selected"
                    @endif>
                {{$post -> title}}</option>
            @endforeach
        </select> --}}
        <select name="user_id">
            <option value="{{$post -> user->id}}">{{$post -> user-> name}}</option>
        </select>
    </p>

    <input type = "submit" value = "Update" id = "submit" >
    <a href="{{ route('posts.index') }}">Cancel</a>

    {{-- <script>        
        document.getElementById("content").addEventListener("keyup", function() {
        var contentIn = document.getElementById('content').value;
        if (contentIn != "") {
            document.getElementById('submit').removeAttribute("disabled");
        } else {
            document.getElementById('submit').setAttribute("disabled", null);
        }
    });
    </script> --}}

    <script>
        function enableSubmit() {
            document.getElementById('submit').disabled =true;
        }
    </script>

</form>

@endsection
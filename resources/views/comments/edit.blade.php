@extends('layouts.app')

@section('title', 'Edit Comment')

@section('content')

<form method = "POST" action = "{{route('comments.update', ['comment' => $comment])}}">
    @csrf
    {{-- <p>Content: <input type = "text" name = "content" id="content" value = {{ $comment-> content }} placeholder = "Enter your comment here"></p> --}}
    <p>
        <p>
        <label for="content">User: </label>
        <textarea name = "content"> {{ $comment-> content }}</textarea>
        </p>
    <p>
        <label for="user_id">User: </label>
        <select name="user_id">
            <option value="{{$user -> id}}">{{$user -> name}}</option>
        </select>
    </p>

    <p>
        <label for="post_id">Post: </label>
        {{-- <select name="post_id">
            @foreach ($posts as $post)
                <option value="{{$post -> id}}"
                    @if ($post->id == old('post_id'))
                        selected = "selected"
                    @endif>
                {{$post -> title}}</option>
            @endforeach
        </select> --}}
        <select name="post_id">
            <option value="{{$comment -> post->id}}">{{$comment -> post-> title}}</option>
        </select>
    </p>

    <input type = "submit" value = "Update" id = "submit" >
    <a href="{{ route('comments.index') }}">Cancel</a>

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
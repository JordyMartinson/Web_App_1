@extends('layouts.app')

@section('title', 'Create Post')

@section('content')

    <form method = "POST" action = "{{route('posts.store')}}">
        @csrf
        <p>Title: <input type = "text" name = "title" id="title" value = "{{ old('title') }}" placeholder = "Enter your title here"></p>
        <p>Content: <input type = "text" name = "content" id="content" value = "{{ old('content') }}" placeholder = "Enter your post here" disabled></p>
        <p>
            <label for="user_id">User: </label>
            <select name="user_id">
                <option value="{{$user -> id}}">{{$user -> name}}</option>
            </select>
        </p>

        <input type = "submit" value = "Submit" id = "submit" disabled>
        <a href="{{ route('posts.create') }}">Cancel</a>

        <script>        
            document.getElementById("title").addEventListener("keyup", function() {
            var titleIn = document.getElementById('title').value;
            if (titleIn != "") {
                document.getElementById('content').removeAttribute("disabled");
            } else {
                document.getElementById('content').setAttribute("disabled", null);
            }});

            document.getElementById("content").addEventListener("keyup", function() {
            var contentIn = document.getElementById('content').value;
            if (contentIn != "") {
                document.getElementById('submit').removeAttribute("disabled");
            } else {
                document.getElementById('submit').setAttribute("disabled", null);
            }});
        </script>

        <script>
            function cancel() {
                document.getElementById('submit').disabled =true;
                document.getElementById('content').disabled =true;
            }
        </script>
    </form>

@endsection
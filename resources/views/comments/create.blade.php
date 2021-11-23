@extends('layouts.app')

@section('title', 'Comment')

@section('content')

    <form method = "POST" action = "{{route('comments.store')}}">
        @csrf
        <p>Content: <input type = "text" name = "content" id="content" onfocus ="this.value = ''" value = "Enter your comment here"></p>

        <p>
            <label for="user_id">User: </label>
            <select name="user_id">
                <option value="{{$user -> id}}">{{$user -> name}}</option>
            </select>
        </p>

        <p>
            <label for="post_id">Post: </label>
            <select name="post_id">
                @foreach ($posts as $post)
                    <option value="{{$post -> id}}">{{$post -> title}}</option>
                @endforeach
            </select>
        </p>

        <input type = "submit" value = "Submit" id = "submit" disabled>
        <input type = "reset" value = "Cancel" onclick = "enableSubmit()");>

        <script>        
            document.getElementById("content").addEventListener("keyup", function() {
            var contentIn = document.getElementById('content').value;
            if (contentIn != "") {
                document.getElementById('submit').removeAttribute("disabled");
            } else {
                document.getElementById('submit').setAttribute("disabled", null);
            }
        });
        </script>

        <script>
            function enableSubmit() {
                document.getElementById('submit').disabled =true;
            }
        </script>

    </form>
@endsection
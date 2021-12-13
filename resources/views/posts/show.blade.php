@extends('layouts.app')

@section('title', 'Post Details')

@section('content')
        
    <ul>
        <h2><b>{{$post -> title}}</b></h2>
        <p>{{$post -> content}}</p>
        <p>Poster: {{$post -> user -> name}}</p>
        <br>



        <form method = "POST" action = "{{route('posts.store')}}">
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
                    <option value="{{$post -> id}}">{{$post -> title}}</option>
                </select>
            </p>
    
            <input type = "submit" value = "Submit" id = "submit" disabled>
            <input type = "reset" value = "Cancel" onclick = "enableSubmit()");>

            @if (Auth::user() ->can('update', $post))
            <a href="{{route('posts.edit', ['post' => $post])}}">Edit</a>
            @endif

            @if (Auth::user() ->can('delete', $post))
            <form method="POST" action="{{ route( 'posts.destroy', ['post' => $post] )}}">
                @csrf
                @method('DELETE')
                <button type = "submit">Delete</button>
            </form>
            @endif
            
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
        
        @php ($count = $post -> comments() -> count())
        @if ($count > 0)
            @for ($i = 0; $i < $count; $i++)
                <p>{{$post -> comments[$i] -> content}}<br>
                From {{$post -> comments[$i] -> user -> name}}</p>
            @endfor
        @endif
    </ul>

@endsection

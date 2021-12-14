<!DOCTYPE html>
<html lang = "en">
    <head>
        <meta charset = "UTF-8">
        <meta name = "viewport" content = "width = device-width, initial-scale = 1.0">
        <meta http-equiv = "X-UA-Compatible" content = "ie=edge">
        <title>Web Application - @yield('title')</title>
        <style>
            .topnav {
                overflow: hidden;
                background-color: rgb(110, 110, 110);
            }
            .topnav a {
                float: left;
                color: #f2f2f2;
                text-align: center;
                padding: 14px 16px;
                text-decoration: none;
                font-size: 17px;
            }
        </style>
    </head>
    <body>

        @if (Gate::allows('isAdmin')) 
            <div class = "topnav">
                <a class="active" href="/home">Home</a>
                <a href="/admin/posts">Posts</a>
                <a href="/admin/comments">Comments</a>
                <a href="/admin/users">Users</a>
                <form method ="POST" action="/logout">
                    @csrf
                    <button type = "submit">Logout</button>
                </form>
            </div>
        @else
            <div class = "topnav">
                <a class="active" href="/home">Home</a>
                <a href="/user/posts/index/all">Posts</a>
                <a href="/user/posts">My Posts</a>
                <a href="/user/comments">My Comments</a>
                @auth
                <form method ="POST" action="/logout">
                    @csrf
                    <button type = "submit">Logout</button>
                </form>
                @endauth
            </div>  
            @endif
        {{-- @else
            <div class = "topnav">
                <a class="active" href="/home">Home</a>
                <a href="/admin/posts">Posts</a>
                <a href="/admin/comments">Comments</a>
                <a href="/admin/users">Users</a>
                @auth
                <form method ="POST" action="/logout">
                    @csrf
                    <button type = "submit">Logout</button>
                </form>
                @endauth
            </div>
            @endif --}}


        

        {{-- <a href="{{route('comments.index')}}">Comments</a>
        <a href="{{route('admin.users.index')}}">Users</a> --}}




        <h1>Web Application - @yield('title')</h1>

        @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
        @endif

        @if (session('message'))
            <p><b>{{session('message')}}</b></p>
        @endif

        <div>
            @yield('content')
        </div>
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
        {{-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script src="{{ asset('js/todo.js') }}" defer></script> --}}

    </body>
</html>
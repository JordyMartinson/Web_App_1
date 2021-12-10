<!DOCTYPE html>
<html lang = "en">
    <head>
        <meta charset = "UTF-8">
        <meta name = "viewport" content = "width = device-width, initial-scale = 1.0">
        <meta http-equiv = "X-UA-Compatible" content = "ie=edge">
        <title>Web Application - @yield('title')</title>
    </head>
    <body>
        <a href="/home">Home</a>
        <a href="/posts">Posts</a>
        <a href="/comments">Comments</a>

        @auth
        <form method ="POST" action="/logout">
            @csrf
            <button type = "submit">Logout</button>
        </form>
        @endauth

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
        <div>
            @yield('commenting')
        </div>
        
    </body>
</html>
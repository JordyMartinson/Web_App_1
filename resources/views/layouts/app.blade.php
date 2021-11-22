<!DOCTYPE html>
<html lang = "en">
    <head>
        <meta charset = "UTF-8">
        <meta name = "viewport" content = "width = device-width, initial-scale = 1.0">
        <meta http-equiv = "X-UA-Compatible" content = "ie=edge">
        <title>Web Application - @yield('title')</title>
    </head>
    <body>
        <a href="/posts">Posts</a>
        <h1>Web Application - @yield('title')</h1>

        <div>
            @yield('content')
        </div>
        <div>
            @yield('commenting')
        </div>
        
    </body>
</html>
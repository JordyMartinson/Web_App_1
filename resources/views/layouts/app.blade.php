<!DOCTYPE html>
<html lang = "en">
    <head>
        <meta charset = "UTF-8">
        <meta name = "viewport" content = "width = device-width, initial-scale = 1.0">
        <meta http-equiv = "X-UA-Compatible" content = "ie=edge">
        <title> @yield('title')</title>
        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <link rel="stylesheet" href="{{ asset('css/appExtra.css') }}">

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
    </head>
    <body>

        @if (Gate::allows('isAdmin')) 
            <div class = "topnav">
                <a class="active" href="/home">Home</a>
                <a href="/admin/posts/index/all">All Posts</a>
                <a href="/admin/comments/index/all">All Comments</a>
                <a href="/admin/users/index/all">All Users</a>
                <a href="/admin/posts">My Posts</a>
                <a href="/admin/comments">My Comments</a>
            </div>
        @elseif (Gate::allows('isUser'))
            <div class = "topnav">
                <a class="active" href="/home">Home</a>
                <a href="/user/posts/index/all">All Posts</a>
                <a href="/user/posts">My Posts</a>
                <a href="/user/comments">My Comments</a>
            </div>
        @else
            <div class = "topnav">
                <a class="active" href="/home">Home</a>
            </div>
        @endif

            <div class = "form-inline my-2 my-lg-0">
                @if (Route::has('login'))
                <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                    @auth
                    <form method ="POST" action="/logout">
                        @csrf
                        <button type = "submit">Logout</button>
                    </form>
                    @else
                        <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</a>
                        @endif
                    @endauth
                </div>
            @endif
            </div>



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

        <main class="container">
            <h1>@yield('title')</h1>
            <div class = "container">
                @yield('content')
            </div>
        </main>

    </body>
</html>
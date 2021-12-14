{{-- @extends('layouts.app')

@section('title', 'Comment Details')

@section('content')
        
    <ul>
        <p>On the post "<a href="/posts/{{$comment->post->id}}">{{$comment -> post -> title}}</a>"</p>
        <p>{{$comment -> content}}</p>
        <p>{{$comment -> user -> name}}</p>
        <br>

        {{-- @php ($count = $post -> comments() -> count())
        @if ($count > 0)
            @for ($i = 0; $i < $count; $i++)
            <p>{{$post -> comments[$i] -> content}}<br>
            From {{$post -> comments[$i] -> user -> name}}</p>
            @endfor
        @endif --}}

        @if (Auth::user() ->can('delete', $comment))
        <form method="POST" action="{{ route( 'comments.destroy', ['comment' => $comment] )}}">
            @csrf
            @method('DELETE')
            <button type = "submit">Delete</button>
        </form>
        @endif

        @if (Auth::user() ->can('update', $comment))
        {{-- <form method="POST" action="{{ route( 'comments.edit', ['comment' => $comment] )}}">
            @csrf
            @method('POST')
            <button type = "submit">Edit</button>
        </form> --}}
        <a href="{{route('comments.edit', ['comment' => $comment])}}">Edit</a>
        @endif

        {{-- @if (Auth::user() ->can('update', $comment))
        <form method="POST" action="{{ route( 'comments.update', ['comment' => $comment] )}}">
            @csrf
            @method('POST')
            <button type = "submit">Edit</button>
        </form>
        @endif --}}

    </ul>

@endsection --}}

@extends('layouts.app')

@section('title')
    Comments
@endsection

@section('content')

    <p>Comments from users: </p>

    <ul>
        @foreach ($users as $user)
            <h3>{{$user -> name}}</h3>
                @php ($count = $user -> comments() -> count())
                @if ($count == 0)
                    -- This user has no comments --
                @else
                    @for ($i = 0; $i < $count; $i++)
                        <li><a href="/posts/{{$user->comments[$i]->post->id}}">{{$user -> comments[$i] -> content}}</a></li>
                    @endfor
                @endif
            </p>
            <br>
        @endforeach
    </ul>

    <a href = "{{route('comments.create')}}">Create Comment</a>

@endsection
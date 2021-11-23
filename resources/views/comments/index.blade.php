@extends('layouts.app')

@section('title')
    Comments
@endsection

@section('content')

    <p>Comments from users: </p>

    <ul>
        <label for="selectUser">Choose user: </label>
        <select name="selectUser" id="selectUser">
            <option value="all">All</option>
            @foreach ($users as $user)
            <option value={{$user->id}}>{{$user->name}}</option>
            @endforeach
        </select>
            {{-- @foreach ($users as $user) --}}
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
        {{-- @endforeach --}}
        {{-- @endif --}}
        
    </ul>

    <a href = "{{route('comments.create')}}">Create Comment</a>

@endsection
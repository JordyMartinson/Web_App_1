@extends('layouts.app')

@section('title', 'All Posts')

@section('content')

@php ($count = $posts -> count())
@if ($count == 0)
      <p>There are no posts.</p>
@else
    <div>
        <table>
            <tr>
                <th>Title</th>
                <th>Posted by</th>
            </tr>
            @foreach ($posts as $post)
            <tr>
                <td>{{$post->title}}</td>
                <td>{{$post->user->name}}</td>
                <td><a class="btn" href="{{route('user.posts.show', $post->id)}}" role="button">Comment</a></td>
            </tr>
            @endforeach
        </table>
        {{ $posts->links() }}
    </div>
@endif

@endsection


{{-- @extends('layouts.app')

@section('title')
    Posts
@endsection

@section('content')

    <p>Posts from users: </p>

    <ul>
        @foreach ($users as $user)
            <h3>{{$user -> name}}</h3>
                @php ($count = $user -> posts() -> count())
                @if ($count == 0)
                    -- This user has no posts --
                @else
                    @for ($i = 0; $i < $count; $i++)
                        <li><a href="/posts/{{$user->posts[$i]->id}}">{{$user -> posts[$i] -> title}}</a></li>
                    @endfor
                @endif

            </p>
            <br>
        @endforeach
    </ul>

    <a href = "{{route('posts.create')}}">Create Post</a>

@endsection --}}
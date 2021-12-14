@extends('layouts.app')

@section('title', 'My Posts')

@section('content')

@php ($count = $posts -> count())
@if ($count == 0)
      <p>You have no posts.</p>
@else
    <div>
        <table>
            <tr>
                <th>Title</th>
                <th>Content</th>
            </tr>
            @foreach ($posts as $post)
            <tr>
                <td>{{$post->title}}</td>
                <td>{{$post->content}}</td>

                <td><a class="btn" href="{{route('user.posts.edit', $post->id)}}" role="button">Edit</a></td>
                <td>
                    <button class="btn" onclick="event.preventDefault(); document.getElementById('delete_post_{{$post->id}}').submit()">Delete</button>
                    <form id="delete_post_{{$post->id}}" action="{{route('user.posts.destroy', $post->id)}}" method='POST'>
                        @csrf
                        @method('DELETE')
                    </form>
                </td>
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

@endsection--}}
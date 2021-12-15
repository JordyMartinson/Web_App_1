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
                <td><a href="{{route('user.posts.show', $post->id)}}">{{$post->title}}</td>
                <td>{{$post->content}}</td>

                <td class = "centered"><a class="btn" href="{{route('user.posts.edit', $post->id)}}" role="button">Edit</a></td>
                <td class = "centered">
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

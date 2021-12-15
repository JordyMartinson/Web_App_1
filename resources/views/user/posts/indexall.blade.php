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
                <td><a href="{{route('user.posts.show', $post->id)}}">{{$post->title}}</a></td>
                <td>{{$post->user->name}}</td>
                <td><a class="btn" href="{{route('user.posts.show', $post->id)}}" role="button">Comment</a></td>
            </tr>
            @endforeach
        </table>
        {{ $posts->links() }}
    </div>
@endif

@endsection

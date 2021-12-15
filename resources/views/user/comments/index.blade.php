@extends('layouts.app')

@section('title', 'My Comments')

@section('content')

@php ($count = $comments -> count())
@if ($count == 0)
      <p>You have no comments.</p>
@else
    <div>
        <table>
            <tr>
                <th>Comment</th>
                <th>Post</th>
            </tr>
            @foreach ($comments as $comment)
            <tr>
                <td>{{$comment->content}}</td>
                <td><a href="{{route('user.posts.show', $comment->post->id)}}">{{$comment->post->title}}</td>
                <td class = "centered"><a class="btn" href="{{route('user.comments.edit', $comment->id)}}" role="button">Edit</a></td>
                <td class = "centered">
                    <button class="btn" onclick="event.preventDefault(); document.getElementById('delete_comment_{{$comment->id}}').submit()">Delete</button>
                    <form id="delete_comment_{{$comment->id}}" action="{{route('user.comments.destroy', $comment->id)}}" method='POST'>
                        @csrf
                        @method('DELETE')
                    </form>
                </td>
            </tr>
            @endforeach
        </table>
        {{ $comments->links() }}
    </div>
@endif

@endsection

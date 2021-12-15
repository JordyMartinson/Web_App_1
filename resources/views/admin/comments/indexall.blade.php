@extends('layouts.app')

@section('title', 'Comments')

@section('content')

    <div>
        <table>
            <tr>
                <th class = "centered">Commenter ID</th>
                <th>Name</th>
                <th>Comment</th>
                <th>Post</th>
            </tr>
            @foreach ($comments as $comment)
            <tr>
                <td class = "centered">{{$comment->user->id}}</td>
                <td>{{$comment->user->name}}</td>
                <td>{{$comment->content}}</td>
                <td><a href="{{route('admin.posts.show', $comment->post->id)}}">{{$comment->post->title}}</a></td>
                <td class = "centered">
                    <button class="btn" onclick="event.preventDefault(); document.getElementById('delete_comment_{{$comment->id}}').submit()">Delete</button>
                    <form id="delete_comment_{{$comment->id}}" action="{{route('admin.comments.destroy', $comment->id)}}" method='POST'>
                        @csrf
                        @method('DELETE')
                    </form>
                </td>
            </tr>
            @endforeach
        </table>
        <div width=100%>{{ $comments->links() }}</div>
    </div>

@endsection
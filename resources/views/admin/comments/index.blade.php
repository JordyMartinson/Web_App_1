@extends('layouts.app')

@section('title', 'Comments')

@section('content')

{{-- <div><a class="btn" href="{{route('admin.users.create')}}" role="button">Create</a></div> --}}

    <div>
        <table>
            <tr>
                <th>Commenter ID</th>
                <th>Name</th>
                <th>Comment</th>
                <th>Post</th>
                {{-- <th></th> --}}
            </tr>
            @foreach ($comments as $comment)
            <tr>
                <td>{{$comment->user->id}}</td>
                <td>{{$comment->user->name}}</td>
                <td>{{$comment->content}}</td>
                <td>{{$comment->post->title}}</td>
                {{-- <td>{{$user->email}}</td> --}}
                {{-- <td><a class="btn" href="{{route('admin.users.edit', $user->id)}}" role="button">Edit</a></td> --}}
                <td>
                    <button class="btn" onclick="event.preventDefault(); document.getElementById('delete_comment_{{$comment->id}}').submit()">Delete</button>
                    <form id="delete_comment_{{$comment->id}}" action="{{route('admin.comments.destroy', $comment->id)}}" method='POST'>
                        @csrf
                        @method('DELETE')
                    </form>
                </td>
            </tr>
            @endforeach
        </table>
        {{ $comments->links() }}
    </div>

@endsection
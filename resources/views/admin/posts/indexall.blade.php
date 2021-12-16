@extends('layouts.app')

@section('title', 'Posts')

@section('content')

<div><a class="btn" href="{{route('admin.posts.create')}}" role="button">Create</a></div>

<div>
    <table>
        <tr>
            <th class = "centered">Poster ID</th>

            <th>Posted by</th>
            <th>Title</th>

        </tr>
        @foreach ($posts as $post)
        <tr>
            <td class = "centered">{{$post->user->id}}</td>
            <td>{{$post->user->name}}</td>
            <td><a class="btn" href="{{route('admin.posts.show', $post)}}">{{$post->title}}</a></td>
            <td class = "centered">
                <button class="btn" onclick="event.preventDefault(); document.getElementById('delete_post_{{$post->id}}').submit()">Delete</button>
                <form id="delete_post_{{$post->id}}" action="{{route('admin.posts.destroy', $post->id)}}" method='POST'>
                    @csrf
                    @method('DELETE')
                </form>
            </td>
        </tr>
        @endforeach
    </table>
    {{ $posts->links() }}
</div>

@endsection
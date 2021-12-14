@extends('layouts.app')

@section('title', 'Posts')

@section('content')

{{-- <div><a class="btn" href="{{route('admin.users.create')}}" role="button">Create</a></div> --}}

    <div>
        <table>
            <tr>
                <th>Poster ID</th>
                <th>Name</th>
                <th>Title</th>
                <th>Content</th>
                {{-- <th></th> --}}
            </tr>
            @foreach ($posts as $post)
            <tr>
                <td>{{$post->user->id}}</td>
                <td>{{$post->user->name}}</td>
                <td>{{$post->title}}</td>
                <td>{{$post->content}}</td>
                {{-- <td>{{$user->email}}</td> --}}
                {{-- <td><a class="btn" href="{{route('admin.users.edit', $user->id)}}" role="button">Edit</a></td> --}}
                <td>
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
@extends('layouts.app')

@section('title', 'All Posts')

@section('content')
<div><a class="btn" href="{{route('user.posts.create')}}" role="button">Create</a></div>
<div>
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
                    <td><a class="btn" href="{{route('user.posts.show', $post)}}">{{$post->title}}</a></td>
                    <td>{{$post->user->name}}</td>
                </tr>
                @endforeach
            </table>
            {{ $posts->links() }}
        </div>
    @endif
</div>
@endsection

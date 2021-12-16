@extends('layouts.app')

@section('title', 'Users')

@section('content')

<div><a class="btn" href="{{route('admin.users.create')}}" role="button">Create</a></div>

<div>
    <table>
        <tr>
            <th class = "centered">User ID</th>
            <th>Name</th>
            <th>Email</th>
            <th></th>
            <th></th>
        </tr>
        @foreach ($users as $user)
        <tr>
            <td class = "centered">{{$user->id}}</td>
            <td>{{$user->name}}</td>
            <td>{{$user->email}}</td>
            <td class = "centered"><a class="btn" href="{{route('admin.users.edit', $user->id)}}" role="button">Edit</a></td>
            <td class = "centered">
                <button class="btn" onclick="event.preventDefault(); document.getElementById('delete_user_{{$user->id}}').submit()">Delete</button>
                <form id="delete_user_{{$user->id}}" action="{{route('admin.users.destroy', $user->id)}}" method='POST'>
                    @csrf
                    @method('DELETE')
                </form>
            </td>
        </tr>
        @endforeach
    </table>
    {{ $users->links() }}
</div>

@endsection
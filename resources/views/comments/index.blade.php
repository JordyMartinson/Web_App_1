@extends('layouts.app')

@section('title')
    Comments
@endsection

@section('content')

    <p>Comments from users: </p>

    <ul>
        <label for="selectUser">Choose user: </label>
        <select name="selectUser" id="selectUser">
            <option value="all">All</option>
            @foreach ($users as $user)
                <option value ="{{$user->id}}">{{$user->name}}</option>
            @endforeach
        </select>
        <button type = "button" id = "btnSelect" onClick = "myFunction({{$chosenUser}})">Select</button>

            {{-- @if ($chosenUser == "all") --}}
                @foreach ($users as $user)
                <h3>{{$user -> name}}</h3>
                    @php ($count = $user -> comments() -> count())
                    @if ($count == 0)
                        -- This user has no comments --
                    @else
                        @for ($i = 0; $i < $count; $i++)
                            <li><a href="/posts/{{$user->comments[$i]->post->id}}">{{$user -> comments[$i] -> content}}</a></li>
                        @endfor
                    @endif
                </p>
                <br>
                @endforeach
            {{-- @else --}}

            {{-- <p>{{$chosenUser}} this is not working</p> --}}


                {{-- <h3>{{$users[$chosenUser] -> name}}</h3>
                @php ($count = $users[$chosenUser] -> comments() -> count())
                @if ($count == 0)
                    -- This user has no comments --
                @else
                    @for ($i = 0; $i < $count; $i++)
                        <li><a href="/posts/{{$users[$chosenUser]->comments[$i]->post->id}}">{{$users[$chosenUser] -> comments[$i] -> content}}</a></li>
                    @endfor
                @endif
                </p>
                <br>

                @endif --}}

                <script>
                    // document.getElementById("selectUser").addEventListener("change", myFunction)
                    function myFunction($chosenUser) {
                        $chosenUser = 3;
                    }

                    if ($chosenUser}== 3) {
                        <p>This is kind of working</p>
                    }
                </script>
        
    </ul>



    <a href = "{{route('comments.create')}}">Create Comment</a>

@endsection
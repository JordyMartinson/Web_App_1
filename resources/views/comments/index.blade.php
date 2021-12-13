@extends('layouts.app')

@section('title')
    Comments
@endsection

@section('content')

    <p>Comments from users: </p>

    {{-- <ul> --}}
        <label for="selectUser">Choose user: </label>
        <select name="selectUser" id="selectUser" onchange="window.location.href=this.value">
            <option value="All">All</option>
            @foreach ($users as $user)
                <option value = {{route('comments.index', ['id' => $user->id-1])}}>{{$user->name}}</option> {{-- defaults to first option, correct url but next user --}}
            @endforeach
        </select>
        {{-- <button type = "button" id = "btnSelect">Select</button> --}}
        {{-- <a href = >Select</a> --}}

            {{-- @if ($chosenUser == "All") --}}
                @foreach ($users as $user)
                <h3>{{$user -> name}}</h3>
                    @php ($count = $user -> comments() -> count())
                    @if ($count == 0)
                        -- This user has no comments --
                    @else
                        @for ($i = 0; $i < $count; $i++)
                            <li><a href="/comments/{{$user->comments[$i]->id}}">{{$user -> comments[$i] -> content}}</a></li>
                        @endfor
                    @endif
                </p>
                <br>
                @endforeach
            {{-- @else
                <h3>{{$users[$chosenUser] -> name}}</h3>
                @php ($count = $users[$chosenUser] -> comments() -> count())
                @if ($count == 0)
                    <p>-- This user has no comments --</p>
                @else
                    @for ($i = 0; $i < $count; $i++)
                        <li><a href="/posts/{{$users[$chosenUser]->comments[$i]->post->id}}">{{$users[$chosenUser] -> comments[$i] -> content}}</a></li>
                    @endfor
                @endif
                </p>
                <br> --}}

                {{-- @endif
                <p id="demo"></p>

                <script>
                    function changeUser() {
                        var x = document.getElementById("selectUser").value;
                        document.getElementById("demo").innerHTML = x;
                        var xRoute = "{{route ('comments.index', ['id' => " + x;
                        xRoute = xRoute + "])}}"
                        document.getElementById("demo").innerHTML = xRoute;
                        echo xRoute;
                    }
                </script> --}}

{{-- <script>
    $(function(){
      // bind change event to select
      $('selectUser').on('change', function () {
          var url = $(this).val(); // get selected value
          if (url) { // require a URL
              window.location = url; // redirect
          }
          return false;
      });
    });
</script> --}}

        
    {{-- </ul> --}}

    {{-- <select id="mySelect" onchange="myFunction()">
        <option value="All">All</option>
            @foreach ($users as $user)
                <option value ="{{$user->id}}">{{$user->name}}</option>
            @endforeach
      </select>
      

      <p>
                  @if ($chosenUser-> == "1")
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
                @endif


      <p id="demo"></p>

      
      
      <script>
      function myFunction() {
        var x = document.getElementById("mySelect").value;
        document.getElementById("demo").innerHTML = x;
      }
      </script> --}}


    <a href = "{{route('comments.create')}}">Create Comment</a>

@endsection
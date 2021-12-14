@extends('layouts.app')

@section('title', 'Post Details')

@section('content')

{{-- <div class="container">

    <div class="d-flex bd-highlight mb-4">
        <div class="p-2 w-100 bd-highlight">
            <h2>Laravel AJAX Example</h2>
        </div>
        <div class="p-2 flex-shrink-0 bd-highlight">
            <button class="btn btn-success" id="btn-add">
                Add Comment
            </button>
        </div>
    </div>

    <div>
        <table class="table table-inverse">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Comment</th>
                    <th>From</th>
                </tr>
            </thead>
            <tbody id="todos-list" name="todos-list">
                @foreach ($comments as $comment)
                <tr id="todo">
                    <td>{{$comment->id}}</td>
                    <td>{{$comment->content}}</td>
                    <td>{{$comment->user->name}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="modal fade" id="formModal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="formModalLabel">Create Comment</h4>
                    </div>
                    <div class="modal-body">
                        <form id="myForm" name="myForm" class="form-horizontal" novalidate="">

                            <div class="form-group">
                                <label>Comment</label>
                                <input type="text" class="form-control" id="comment" name="comment"
                                        placeholder="Enter comment" value="">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" id="btn-save" value="add">Save changes
                        </button>
                        <input type="hidden" id="todo_id" name="todo_id" value="0">
                    </div>
                </div>
            </div>
        </div>

    </div>
</div> --}}
        
{{-- <head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
</head>
<body> --}}
    {{-- <div>
        <h2><b>{{$post -> title}}</b></h2>
        <p>{{$post -> content}}</p>
        <p>Poster: {{$post -> user -> name}}</p>
        <br>
    </div> --}}

    {{-- <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
<h1>Enclosures</h1>
<div id="root">
    <ul>
        <li v-for="comment in comments">@{{comment}}</li>
    </ul>
</div>
<script>
    var app = new Vue({
        el: "#root",
        data: {
            comments: ["Comment 1", "Comment 2"]
        }
    });
</script> --}}


    {{-- <div class="container">
       <form id="myForm">
          <div class="form-group">
            <label for="content">Comment:</label>
            <input type="text" class="form-control" id="name">
          </div>
          <div class="form-group">
             <label for="post_id">Post ID:</label>
             <input type="text" class="form-control" id="price">
           </div>
          <button class="btn btn-primary">Submit</button>
        </form>
    </div>
    <script src="http://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script>
    jQuery(document).ready(function(){
       jQuery('#ajaxSubmit').click(function(e){
          e.preventDefault();
          $.ajaxSetup({
             headers: {
                 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
             }
         });
          jQuery.ajax({
             url: "{{ url('/user/post') }}",
             method: 'post',
             data: {
                content: jQuery('#content').val(),
                post_id: jQuery('#post_id').val(),
             },
             success: function(result){
                jQuery('.alert').show();
                jQuery('.alert').html(result.success);
             }});
          });
       });
</script> --}}
  {{-- </body>
</html> --}}

    {{-- <ul>
        <h2><b>{{$post -> title}}</b></h2>
        <p>{{$post -> content}}</p>
        <p>Poster: {{$post -> user -> name}}</p>
        <br>
        
        <form method = "POST" action = "{{route('user.comments.store')}}">
            @csrf
            <p>Content: <input type = "text" name = "content" id="content" onfocus ="this.value = ''" value = "Enter your comment here"></p>
    
            {{-- <p>
                <label for="user_id">User: </label>
                <select name="user_id">
                    <option value="{{$user -> id}}">{{$user -> name}}</option>
                </select>
            </p> --}}
    
            {{-- <p>
                <label for="post_id">Post: </label>
                <select name="post_id">
                    <option value="{{$post -> id}}">{{$post -> title}}</option>
                </select>
            </p> --}}
    
            {{-- <input type = "submit" value = "Submit" id = "submit" disabled>
            <input type = "reset" value = "Cancel" onclick = "enableSubmit()");>

            @if (Auth::user() ->can('update', $post))
            <a href="{{route('user.posts.edit', ['post' => $post])}}">Edit</a>
            @endif

            @if (Auth::user() ->can('delete', $post))
            <form method="POST" action="{{ route( 'user.posts.destroy', ['post' => $post] )}}">
                @csrf
                @method('DELETE')
                <button type = "submit">Delete</button>
            </form>
            @endif
            
            <script>        
                document.getElementById("content").addEventListener("keyup", function() {
                var contentIn = document.getElementById('content').value;
                if (contentIn != "") {
                    document.getElementById('submit').removeAttribute("disabled");
                } else {
                    document.getElementById('submit').setAttribute("disabled", null);
                }
            });
            </script>
    
            <script>
                function enableSubmit() {
                    document.getElementById('submit').disabled =true;
                }
            </script>
        </form>
        
        @php ($count = $post -> comments() -> count())
        @if ($count > 0)
            @for ($i = 0; $i < $count; $i++)
                <p>{{$post -> comments[$i] -> content}}<br>
                From {{$post -> comments[$i] -> user -> name}}</p>
            @endfor
        @endif
    </ul> --}}

@endsection

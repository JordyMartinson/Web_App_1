@extends('layouts.app')

@section('title', 'Post Details')

@section('content')

<body>
    <div class = "container">
        <h2><b>{{$post -> title}}</b></h2>
        <p>{{$post -> content}}</p>
        <p>Posted by {{$post -> user -> name}}</p>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.12/dist/vue.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.24.0/axios.min.js"
        integrity="sha512-u9akINsQsAkG9xjc1cnGF4zw5TFDwkxuc9vUp5dltDWYCSmyd0meygbvgXrlc/z7/o4a19Fb5V0OUE58J7dcyw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <h2>Comments</h2>
    <div id="root">
        <ul>
            <li v-for="comment in comments">@{{ comment.content }}</li>
        </ul>
        <h2>New Comment</h2>
        Comment: <input type="text" id ="content" v-model="newComment">
        <button @click="createComment">Submit</button>
    </div>
    <script>
        var app = new Vue({
            el: "#root",
            data: {
                comments: [],
                newComment: '',
            },
            methods: {
                createComment:function(){
                    axios.post("{{route('api.comments.store')}}",
                    {
                        content:this.newComment
                    }).then(response=>{
                        this.comments.push(response.data);
                        this.newComment='';
                    }).catch(response=>{
                        console.log(response);
                    })
                }
            },
            mounted() {
                axios.get("{{route('api.comments.index', $post->id)}}").then(response=>{
                    this.comments = response.data;
                }).catch(response=>{
                    console.log(response);
                })
            }
        });
    </script>
</body>
</html>
@endsection

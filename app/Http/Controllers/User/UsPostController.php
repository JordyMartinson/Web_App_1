<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class UsPostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::where('user_id', auth()->id())->paginate(10);
        return view('user.posts.index', ['posts' => $posts]);
    }

    public function indexAll()
    {
        $posts = Post::paginate(10);
        return view('user.posts.indexall', ['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $post = Post::findOrFail($id);
        $comments = Comment::all(); // find specific
        return view('user.posts.show', ['post' => $post, 'comments' => $comments]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Post::destroy($id);
        return redirect() -> route('user.posts.index');
    }

    public function apiIndex()
    {
        $comments = Comment::where('post_id', $post);
        return $comments;
    }

    public function apiStore(Request $request){

        // $validatedData = $request -> validate([
        //     'content' => 'required|max:100',
        //     // 'user_id' => 'required', //change
        //     // 'post_id' => 'required'  //change
        // ]);

        $c = new Comment;
        $c -> content = $request['content'];
        $c -> user_id = 1; // change
        $c -> post_id = 1; // change
        $c -> save();
        return $c;
    }
}

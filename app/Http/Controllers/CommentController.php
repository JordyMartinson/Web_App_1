<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\User;
use App\Models\Post;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function index($id)
    public function index()
    {
        // if ($id = "All") {
        //     $chosenUser = "All";
        // }
        // else {
        //     $chosenUser = User::findOrFail($id)->id;
        // }
        // $chosenUser = User::findOrFail($id)->id;
        // $users = User::orderBy('name', 'asc')->get();
        $users = User::all();
        $comments = Comment::orderBy('content', 'asc')->get();
        // return view('comments.index', ['users' => $users, 'chosenUser' => $chosenUser, 'comments' => $comments]);
        return view('comments.index', ['users' => $users, 'comments' => $comments]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $users = User::orderBy('name', 'asc')->get();
        // $posts = Post::orderBy('title', 'asc')->get();
        // $users = User::all();
        // $posts = Post::all();
        // return view('comments.create', ['users' => $users, 'posts' => $posts]);

        $user = Auth() -> user();
        $posts = Post::orderBy('title', 'asc')->get();
        return view('comments.create', ['user' => $user, 'posts' => $posts]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request -> validate([
            'content' => 'required|max:100',
            'user_id' => 'required', //change
            'post_id' => 'required'  //change
        ]);

        $c = new Comment;
        $c -> content = $validatedData['content'];
        $c -> user_id = $validatedData['user_id']; // change
        $c -> post_id = $validatedData['post_id']; // change
        $c -> save();

        session() -> flash('message', 'Comment created.');

        return redirect() -> route('comments.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        return view('comments.show', ['comment' => $comment]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
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
    public function update(Request $request, Comment $comment)
    {
        // if ($request->user()->cannot('update', $comment)) {
        //     abort(403);
        // }
        $this->authorize('update', $comment);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        $this->authorize('delete', $comment);
        $comment->delete();
        return redirect()->route('comments.index')->with('message', 'Comment deleted.');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Support\Facades\Gate;

class AdPostController extends Controller
{
    /**
     * Display all posts from the user.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $p = Post::where('user_id', auth()->id())->first();
        if(is_null($p) && Gate::allows('isAdmin')) {
            $p = Post::where('user_id', auth()->id())->paginate(10);
            return view('admin.posts.index', ['posts' => $posts]);
        }
        
        if(Gate::allows('isAdmin') && (Gate::allows('ownsPost', $p))) {
            $posts = Post::where('user_id', auth()->id())->paginate(10);
            return view('admin.posts.index', ['posts' => $posts]);
        } else {
            return redirect()->route('home')->with('message', 'You must be the comment owner to access this page.');
        }
    }

    /**
     * Displays all posts from all users.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexAll()
    {
        if(Gate::allows('isAdmin')) {
            $posts = Post::paginate(10);
            return view('admin.posts.indexall', ['posts' => $posts]);
        } else {
            return redirect()->route('home')->with('message', 'You must be logged in to access this page.');
        }
    }      


    /**
     * Show the form for creating a new post.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Gate::allows('isAdmin')) {
            $user = Auth() -> user();
            return view('admin.posts.create', ['user' => $user]);
        } else {
            return redirect()->route('home')->with('message', 'You must be logged in to post');
        }
    }

    /**
     * Store a newly created post.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(Gate::allows('isAdmin')) {
            $userID = auth()->id();
            $validatedData = $request -> validate([
                'title' => 'required|max:100',
                'content' => 'required|max:500',
            ]);

            $p = new Post;
            $p -> title = $validatedData['title'];
            $p -> content = $validatedData['content'];
            $p -> user_id = $userID;
            $p->save();

            session() -> flash('message', 'Post created.');
            return redirect()->route('admin.posts.index');
        } else {
            return redirect()->route('home')->with('message', 'You must be logged in to post.');
        }
    }

    /**
     * Display a post.
     *
     * @param  Post $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        if(Gate::allows('isAdmin')) {
            $postGet = Post::findOrFail($post->id);
            $comments = Comment::where('post_id', $post->id);
            $users = User::all();
            return view('admin.posts.show', ['post' => $postGet, 'comments' => $comments, 'users' => $users]);
        } else {
            return redirect()->route('home')->with('message', 'You must be logged in to access this page.');
        }
    }

    /**
     * Show the form for editing a post.
     *
     * @param  Post $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        if(Gate::allows('ownsPost', $post) && Gate::allows('isAdmin')) {
            return view('admin.posts.edit', ['post' => $post]);
        } else {
            return redirect()->route('home')->with('message', 'You must be the post owner to edit a post.');
        }
    }

    /**
     * Update a post.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Post $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        if(Gate::allows('ownsPost', $post) && Gate::allows('isAdmin')) {
            $id = $post->id;
            Post::find($id)->update([
                'title' => $request['title'],
                'content' => $request['content']
            ]);
    
            session() -> flash('message', 'Post edited.');
            return redirect() -> route('admin.posts.index');
        } else {
            return redirect()->route('home')->with('message', 'You must be the post owner to edit a post.');
        }
    }

    /**
     * Remove a post.
     *
     * @param  Post $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        if(Gate::allows('ownsPost', $post) && Gate::allows('isAdmin')) {
            Post::destroy($post->id);
            return redirect() -> route('admin.posts.indexall');
        } else {
            return redirect()->route('home')->with('message', 'You must be the comment owner or an admin to delete a comment.');
        }
    }
}

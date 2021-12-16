<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class UsPostController extends Controller
{
    /**
     * Display all posts from the user.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $p = Post::where('user_id', auth()->id())->first();
        if(is_null($p) && Gate::allows('isUser')) {
            $p = Post::where('user_id', auth()->id())->paginate(10);
            return view('user.posts.index', ['posts' => $p]);
        }
        
        if(Gate::allows('isUser') && (Gate::allows('ownsPost', $p))) {
            $posts = Post::where('user_id', auth()->id())->paginate(10);
            return view('user.posts.index', ['posts' => $posts]);
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
        if(Gate::allows('isUser')) {
            $posts = Post::paginate(10);
            return view('user.posts.indexall', ['posts' => $posts]);
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
        if(Gate::allows('isUser')) {
            $user = Auth() -> user();
            return view('user.posts.create', ['user' => $user]);
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
        if(Gate::allows('isUser')) {
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
            return redirect()->route('user.posts.index');
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
        if(Gate::allows('isUser')) {
            $postGet = Post::findOrFail($post->id);
            $comments = Comment::where('post_id', $post->id);
            $users = User::all();
            return view('user.posts.show', ['post' => $postGet, 'comments' => $comments, 'users' => $users]);
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
        if(Gate::allows('ownsPost', $post) && Gate::allows('isUser')) {
            return view('user.posts.edit', ['post' => $post]);
        } else {
            return redirect()->route('home')->with('message', 'You must be the post owner to access this page.');
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
        $id = $post->id;
        if(Gate::allows('ownsPost', $post) && Gate::allows('isUser')) {

            Post::find($id)->update([
                'title' => $request['title'],
                'content' => $request['content']
            ]);

            session() -> flash('message', 'Post edited.');
            return redirect() -> route('user.posts.index');
        } else {
            return redirect()->route('home')->with('message', 'You must be the post owner to access this page.');
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
        if(Gate::allows('ownsPost', $post) && Gate::allows('isUser')) {
            Post::destroy($post->id);
            return redirect() -> route('user.posts.index');
        } else {
            return redirect()->route('home')->with('message', 'You must be the comment owner or an admin to delete a comment.');
        }
    }
}

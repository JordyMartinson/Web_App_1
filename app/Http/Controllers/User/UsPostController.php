<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Gate;

class UsPostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $p = Post::where('user_id', auth()->id())->first();
        if(is_null($p)) {
            $p = Post::where('user_id', auth()->id())->paginate(10);
            return view('user.posts.index', ['posts' => $posts]);
        }
        
        if(Gate::allows('isUser') && (Gate::allows('ownsPosts', $c))) {
            $posts = Post::where('user_id', auth()->id())->paginate(10);
            return view('user.posts.index', ['posts' => $posts]);
        }
        else {
            return redirect()->route('home')->with('message', 'You must be the comment owner to access this page.');
        }
    }

    public function indexAll()
    {


        if(Gate::allows('loggedIn')) {
            $posts = Post::paginate(10);
            return view('user.posts.indexall', ['posts' => $posts]);
        } else {
            return redirect()->route('home')->with('message', 'You must be logged in to access this page.');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {


        if(Gate::allows('loggedIn')) {
            $user = Auth() -> user();
            return view('user.posts.create', ['user' => $user]);
        } else {
            return redirect()->route('home')->with('message', 'You must be logged in to post');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        
            if(Gate::allows('loggedIn')) {
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        if(Gate::allows('loggedIn')) {
            $postGet = Post::findOrFail($id);
        $comments = Comment::all(); // find specific
        return view('user.posts.show', ['post' => $postGet, 'comments' => $comments]);
                   } else {
                return redirect()->route('home')->with('message', 'You must be logged in to access this page.');
            }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        if(Gate::allows('updatePost', $post)) {
            return view('user.posts.edit', ['post' => $post]);
        }
        else {
            return redirect()->route('home')->with('message', 'You must be the post owner to access this page.');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $id = $post->id;
        if(Gate::allows('updatePost', $post)) {

            Post::find($id)->update([
                'title' => $request['title'],
                'content' => $request['content']
            ]);

            session() -> flash('message', 'Post edited.');
            return redirect() -> route('user.posts.index');
        }
        else {
            return redirect()->route('home')->with('message', 'You must be the post owner to access this page.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {


        if(Gate::allows('isUser')) {
            Post::destroy($post->id);
            return redirect() -> route('user.posts.index');
        }
        else {
            return redirect()->route('home')->with('message', 'You must be the comment owner or an admin to delete a comment.');
        }
    }
}

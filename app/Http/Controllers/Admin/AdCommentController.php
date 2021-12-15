<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Support\Facades\Gate;

class AdCommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $c = Comment::where('user_id', auth()->id())->first();
        if(is_null($c)) {
            $comments = Comment::where('user_id', auth()->id())->paginate(10);
            return view('admin.comments.index', ['comments' => $comments]);
        }
        
        if(Gate::allows('isAdmin') && (Gate::allows('ownsComment', $c))) {
            $comments = Comment::where('user_id', auth()->id())->paginate(10);
            return view('admin.comments.index', ['comments' => $comments]);
        }
        else {
            return redirect()->route('home')->with('message', 'You must be the comment owner to access this page.');
        }
    }

    public function indexAll()
    {
        if(Gate::allows('loggedIn')) {
            $comments = Comment::paginate(10);
            return view('admin.comments.indexall', ['comments' => $comments]);
        } else {
            return redirect()->route('home')->with('message', 'You must be logged in to access this page.');
        }
    }

    // /**
    //  * Show the form for creating a new resource.
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    // public function create()
    // {
    //     //
    // }

    // /**
    //  * Store a newly created resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @return \Illuminate\Http\Response
    //  */
    // public function store(Request $request)
    // {
    //     //
    // }

    // /**
    //  * Display the specified resource.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function show($id)
    // {
    //     //
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        if(Gate::allows('ownsComment', $comment)) {
            return view('admin.comments.edit', ['comment' => $comment]);
        }
        else {
            return redirect()->route('home')->with('message', 'You must be the comment owner to access this page.');
        }
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
        if(Gate::allows('ownsComment', $comment)) {

            Comment::find($comment->id)->update([
                'content' => $request['content'],
                'user_id' => auth()->id(),
                'post_id' => $comment->post->id
            ]);

            session() -> flash('message', 'Comment edited.');
            return redirect() -> route('admin.comments.index');
        }
        else {
            return redirect()->route('home')->with('message', 'You must be the comment owner to access this page.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        if(Gate::allows('isAdmin')) {
            Comment::destroy($comment -> id);
            session() -> flash('message', 'Comment deleted.');
            return redirect() -> route('admin.comments.indexall');
        }
        else {
            return redirect()->route('home')->with('message', 'You must be the comment owner or an admin to delete a comment.');
        }
    }
}

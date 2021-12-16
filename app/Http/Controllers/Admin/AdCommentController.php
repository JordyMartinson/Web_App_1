<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Support\Facades\Gate;

class AdCommentController extends Controller
{
    /**
     * Displays all comments associated with the user.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $c = Comment::where('user_id', auth()->id())->first();
        if(is_null($c) && Gate::allows('isAdmin')) {
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

    /**
     * Displays all comments from all users.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexAll()
    {
        if(Gate::allows('isAdmin')) {
            $comments = Comment::paginate(10);
            return view('admin.comments.indexall', ['comments' => $comments]);
        } else {
            return redirect()->route('home')->with('message', 'You must be logged in to access this page.');
        }
    }

    /**
     * Show the form for editing a comment.
     *
     * @param  Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        if(Gate::allows('ownsComment', $comment) && Gate::allows('isAdmin')) {
            return view('admin.comments.edit', ['comment' => $comment]);
        } else {
            return redirect()->route('home')->with('message', 'You must be the comment owner to access this page.');
        }
    }

    /**
     * Update a comment.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
    {
        if(Gate::allows('ownsComment', $comment) && Gate::allows('isAdmin')) {
            Comment::find($comment->id)->update([
                'content' => $request['content'],
                'user_id' => auth()->id(),
                'post_id' => $comment->post->id
            ]);

            session() -> flash('message', 'Comment edited.');
            return redirect() -> route('admin.comments.index');
        } else {
            return redirect()->route('home')->with('message', 'You must be the comment owner to access this page.');
        }
    }

    /**
     * Remove a comment.
     *
     * @param  Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        if(Gate::allows('ownsComment', $comment) && Gate::allows('isAdmin')) {
            Comment::destroy($comment -> id);
            session() -> flash('message', 'Comment deleted.');
            return redirect() -> route('admin.comments.indexall');
        } else {
            return redirect()->route('home')->with('message', 'You must be the comment owner or an admin to delete a comment.');
        }
    }
}

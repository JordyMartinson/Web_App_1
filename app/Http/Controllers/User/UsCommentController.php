<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class UsCommentController extends Controller
{
    /**
     * Displays all comments associated with the user.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $c = Comment::where('user_id', auth()->id())->first();
        if(is_null($c) && Gate::allows('isUser')) {
            $comments = Comment::where('user_id', auth()->id())->paginate(10);
            return view('user.comments.index', ['comments' => $comments]);
        }
        
        if(Gate::allows('isUser') && (Gate::allows('ownsComment', $c))) {
            $comments = Comment::where('user_id', auth()->id())->paginate(10);
            return view('user.comments.index', ['comments' => $comments]);
        }
        else {
            return redirect()->route('home')->with('message', 'You must be the comment owner to access this page.');
        }
    }

    /**
     * Show the form for editing a comment.
     *
     * @param  Comment $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        if(Gate::allows('ownsComment', $comment) && Gate::allows('isUser')) {
            return view('user.comments.edit', ['comment' => $comment]);
        } else {
            return redirect()->route('home')->with('message', 'You must be the comment owner to access this page.');
        }
    }

    /**
     * Update a comment.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Comment $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
    {
        if(Gate::allows('ownsComment', $comment) && Gate::allows('isUser')) {
            Comment::find($comment->id)->update([
                'content' => $request['content']
            ]);

            session() -> flash('message', 'Comment edited.');
            return redirect() -> route('user.comments.index');
        } else {
            return redirect()->route('home')->with('message', 'You must be the comment owner to access this page.');
        }
    }

    /**
     * Remove a comment.
     *
     * @param  Comment $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        if(Gate::allows('ownsComment', $comment) && Gate::allows('isUser')) {
            Comment::destroy($comment->id);
            return redirect() -> route('user.comments.index');
        } else {
            return redirect()->route('home')->with('message', 'You must be the comment owner or an admin to delete this comment.');
        }
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class APIController extends Controller
{

    /**
     * Retrieve comments related to a post.
     * 
     * @param  Post $post
     * @return \Illuminate\Http\Response
     */
    public function apiIndex(Post $post)
    {
        $comments = Comment::where('post_id', $post->id)->get();
        return $comments;
    }

    /**
     * Store a newly created comment and return details.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function apiStore(Request $request){
        $validatedData = $request -> validate([
            'content' => 'required|max:100',
            'user_id' => 'required', 
            'post_id' => 'required'  
        ]);

        $c = new Comment;
        $c -> content = $validatedData['content'];
        $c -> user_id =$validatedData['user_id'];
        $c -> post_id = $validatedData['post_id'];
        $c -> save();
        return $c;
    }
}

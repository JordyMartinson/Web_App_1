<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Post;

class APIController extends Controller
{
    public function apiIndex(Post $post)
    {
        $comments = Comment::where('post_id', $post->id)->get();
        return $comments;
    }

    public function apiStore(Request $request){
        $validatedData = $request -> validate([
            'content' => 'required|max:100',
            // 'user_id' => 'required', //change
            // 'post_id' => 'required'  //change
        ]);
        // $u = auth()->id;

        $c = new Comment;
        $c -> content = $validatedData['content'];
        // $c -> user_id = $validatedData['user_id']; // change
        $c -> user_id = 1; //change
        $c -> post_id = 1; // change
        $c -> save();
        return $c;
    }
}

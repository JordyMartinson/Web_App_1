<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function image() {
        return view('image');
    }

    public function imagePost(Request $request) {
        $request->validate([
            'image' => 'required|image'
        ]);

        $imageName = time().'.'.$request->image->extension();
        $request->image->move(public_path('images'), $imageName);
        return back()
        ->with('success','You have successfully uploaded image.')
        ->with('image',$imageName); 
    }
}

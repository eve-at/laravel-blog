<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Post $post, Request $request) 
    {
        // validation 
        request()->validate([
            'body' => 'required'
        ]);

        $comment = $post->comments()->create([
            'user_id' => $request->user()->id,
            'body' => $request->input('body')
        ]);

        // Redirect back to the post
        // return back()->with('success', 'Thank you for posting out!');

        // Redirect back to the post and scroll to the new comment
        return redirect()
            ->to(app('url')->previous() . '#comment' . $comment->id)
            ->with('success', 'Thank you for posting out!');
    }
    
}

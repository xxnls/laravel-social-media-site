<?php

namespace App\Http\Controllers;
use App\Models\Comment;

use Illuminate\Http\Request;

class CommentsController extends Controller
{
    public function store(Request $request, $id)
    {
        $request->validate([
            'content' => 'required'
        ]);

        $comment = new Comment();
        $comment->content = $request->input('content');
        $comment->post_id = $id;
        $comment->user_id = auth()->user()->id;
        $comment->updated_at = null;
        $comment->save();

        return response()->json(['message' => 'Comment added successfully.', 'comment' => $comment], 200);
    }
}

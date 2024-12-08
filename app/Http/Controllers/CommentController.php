<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store()
    {
        $comment = new Comment();
        $comment->content = request()->content;
        $comment->article_id = request()->article_id;
        $comment->user_id = auth()->user()->id;
        $comment->save();

        return back();
    }

    public function destroy($id)
    {
        $comment = Comment::find($id);

        if ($comment->user_id == auth()->user()->id) {
            $comment->delete();
            return back()->with('success', 'Comment has been deleted!');
        }
        else {
            return back()->with('error', 'Unauthorized');
        }
    }
}

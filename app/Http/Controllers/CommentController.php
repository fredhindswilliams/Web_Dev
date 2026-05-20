<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $comments =  Comment::all();
        return view('comments.index', ['comments' => $comments]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('comments.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Post $post, User $user)
    {
        $validatedData = $request->validate([
            'body' => 'required|max:255'
        ]);

        $c = new Comment;
        $c->body = $validatedData['body'];
        $c->user_id = $user->id;
        $c->post_id = $post->id;
        $c->save();

        session()->flash('message', "Comment created.");
        return redirect()->route('comments.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        return view('comments.show', ['comment' => $comment]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comment $comment)
    {
        if (($post->user_id !== auth()->id()) && auth()->user()->admin_status === false)  {
            abort(403, 'Unauthorized');
        }

        $request->validate([
            'body' => 'required|string|max:1000',
        ]);

        $comment->body = $request->body;
        $comment->save();

        return response()->json([
            'success' => true,
            'body' => $comment->body
        ]);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::latest()->paginate(10);
        return view('posts.index', ['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tags = Tag::all();
        return view('posts.create', compact('tags'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:127',
            'body' => 'required|max:511',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpg,jpeg,png,gif|max:2048',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id'
        ]);

        $p = new Post;
        $p->title = $validatedData['title'];
        $p->body = $validatedData['body'];
        $p->user_id = auth()->id();
        $p->save();

        if ($request->has('tags')) {
            $p->tags()->attach($request->tags);
        }
        if ($request->has('images')) {
            foreach ($request->images as $image) {
                $path = $image->store('post_images', 'public');
                $p->images()->create([
                    'path' => $path,
                ]);
            }
        }
        return redirect()->route('posts.index')
        ->with('success', 'Post created.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view('posts.show', ['post' => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        if (($post->user_id !== auth()->id()) && auth()->user()->admin_status === false)  {
            abort(403, 'Unauthorized');
        }
        $tags = Tag::all();
        return view('posts.edit', compact('post', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        if ($post->user_id !== auth()->id() && auth()->user()->admin_status === false) {
            abort(403);
        }
        $request->validate([
            'title' => 'required|string',
            'body' => 'required|string',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id',
        ]);
        $post->update([
            'title' => $request->title,
            'body' => $request->body,
        ]);

        if ($request->has('tags')) {
            $post->tags()->sync($request->tags);
        } else {
            $post->tags()->sync([]);
        
        }
        return redirect()->route('posts.show', $post)
        ->with('success', 'Post updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()->route('posts.index')
        ->with('message', 'Post deleted.');
    }
}

<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use App\Notifications\NewCommentNotification;

class Comments extends Component
{
    public $post;
    public $body = '';

    public $editingCommentId = null;
    public $editingBody = '';

    public function mount($post)
    {
        $this->post = $post;
    }

    public function createComment()
    {   
        $this->validate([
            'body' => 'required|string|max:1000',
        ]);
        $comment = Comment::create([
            'user_id' => auth()->id(),
            'post_id' => $this->post->id,
            'body' => $this->body,
        ]);
        if ($this->post->user_id !== auth()->id()) {
            $this->post->user->notify(new NewCommentNotification($comment));
        }
        $this->body = '';
    }

    public function startEditing(Comment $comment)
    {
        $this->editingCommentId = $comment->id;
        $this->editingBody = $comment->body;
    }

    public function saveEdit()
    {
        Comment::find($this->editingCommentId)->update([
            'body' => $this->editingBody
        ]);

        $this->editingCommentId = null;
        $this->editingBody = '';
    }

    public function deleteComment(Comment $comment)
    {
        $comment->delete();
    }

    public function render()
    {
        return view('livewire.comments', [
            'comments' => $this->post->comments()->latest()->get(),
        ]);
    }
}

<div>
    <form wire:submit.prevent="createComment">
        <textarea wire:model.defer="body" placeholder="Write a comment..."></textarea>
        <button type="submit">Post</button>
    </form>

    @foreach ($comments as $comment)
        <div 
            class="mb-2 max-w-3xl border-2 border-black bg-white"
            wire:key="comment-{{ $comment->id }}"
        >
            @if ($editingCommentId === $comment->id)
                <textarea wire:model.defer="editingBody"></textarea>
                <button wire:click="saveEdit">Save</button>
            @else
                <p>{{ $comment->body }}</p>
                <p><a href="{{route('profiles.show', ['user' => $comment->user])}}">{{ $comment->user->name }}</a></p>

                @if (auth()->id() === $comment->user_id || auth()->user()?->admin_status)
                    <button wire:click="startEditing({{ $comment->id }})">Edit</button>
                    <button wire:click="deleteComment({{ $comment->id }})">Delete</button>
                @endif
            @endif
        </div>
    @endforeach
</div>

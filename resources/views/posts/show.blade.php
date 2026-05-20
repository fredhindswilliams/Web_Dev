@extends('layouts.app')

@section('title', 'Post details')

@section('content')
    <ul>
        <li><b>Title:</b> {{ $post->title }}</li>
        <li><b>Body:</b> {{ $post->body }}</li>
        @foreach ($post->images as $image)
            <img src="{{ asset('storage/' . $image->path) }}" alt="Post Image" title="Post Image" class="h-16 w-auto">
        @endforeach
        @if($post->tags->count())
            <p><b>Tags:</b>
            @foreach($post->tags as $tag)
                <span class="badge">{{ $tag->name }}.</span>
            @endforeach
            </p>
        @endif
        <li><b>Author:</b> <a href="{{route('profiles.show', ['user' => $post->user])}}">{{ $post->user->name }}</a></li>
    </ul>
    @if(Auth::check() && (Auth::id() === $post->user_id|| auth()->user()->admin_status))
        <div style="display: flex; gap: 5px;">
            <form method="GET"
            action="{{ route('posts.edit', $post) }}">
                <button type="submit">Edit</button>
            </form>
            <form method="POST"
            action="{{ route('posts.destroy', ['post' => $post]) }}">
                @csrf
                @method('DELETE')
                <button type="submit">Delete</button>
            </form>
        </div>
    @endif

    <p><a href="{{route('posts.index') }}">Back</a></p>

    <livewire:comments :post="$post" />
@endsection
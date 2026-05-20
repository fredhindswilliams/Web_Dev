@extends('layouts.app')

@section('title', 'Edit post')

@section('content')
    <form action="{{ route('posts.update', $post) }}" method="POST">
    @csrf
    @method('PUT')

    <p><b>Title:</b> <input type="text" name="title" value="{{ old('title', $post->title) }}" required> </p>
    
    <p><b>Body:</b> <textarea name="body" required>{{ old('body', $post->body) }}</textarea> </p>

    @foreach ($post->images as $image)
        <img src="{{ asset('storage/' . $image->path) }}" alt="Post Image" title="Post Image" height ="300">
    @endforeach

    <b>Tags:</b>
    @foreach($tags as $tag)
        <label>
            <input type="checkbox" name="tags[]" value="{{ $tag->id }}"
                {{ isset($post) && $post->tags->contains($tag->id) ? 'checked' : '' }}>
            {{ $tag->name }}
        </label>
    @endforeach

    <button type="submit">Save Changes</button>
</form>
@endsection
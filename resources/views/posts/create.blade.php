@extends('layouts.app')

@section('title', 'Create post')

@section('content')
    <form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data">
        @csrf
        <p><b>Title:</b> <input type="text" name="title" value="{{old('title')}}"></p>
        <p><b>Body:</b> <input type="text" name="body" value="{{old('body')}}"></p>
        <p><b>Images:</b> <input type="file" name="images[]" multiple></p>
        <b>Tags: </b>
        @foreach($tags as $tag)
            <label>
                <input type="checkbox" name="tags[]" value="{{ $tag->id }}"
                    {{ isset($post) && $post->tags->contains($tag->id) ? 'checked' : '' }}>
                {{ $tag->name }}
            </label>
        @endforeach
        <br>
        <input type="submit" name="Submit" class = "bg-blue-600 text-white">
        <a href="{{ route('posts.index') }}">Cancel</a>
    </form>
@endsection
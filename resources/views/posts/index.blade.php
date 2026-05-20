@extends('layouts.app')

@section('title', 'Posts')

@if (session('message'))
    <p><b>{{ session('message')}}</b></p>
@endif

@section('content')
    <a href="{{ route('posts.create' )}}">Create a post</a>
    <p> All posts: </p>
    <ul>
        @foreach ($posts as $post)
            <li><a href="{{ route('posts.show', ['post' => $post])}}">{{$post->title}}</a></li>
            <li>Author: <a href="{{ route('profiles.show', ['user' => $post->user])}}">{{$post->user->name}}</a></li>
            <br>
        @endforeach
    </ul>
        {{ $posts->links() }}
@endsection
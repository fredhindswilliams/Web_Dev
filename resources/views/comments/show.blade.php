@extends('layouts.app')

@section('title', 'Comment details')

@section('content')
<p> Post: </p>
    <ul>
            <li>Title: {{ $comment->post->title }}</li>
            <li>Body: {{ $comment->post->body }}</li>
            <li>Author : <a href="{{route('users.show', ['user' => $comment->post->user])}}">{{ $comment->post->user->name }}</a></li>
    </ul>
<p> Comment: </p>
    <ul>
            <li>Body: {{ $comment->body }}</li>
            <li>Author : <a href="{{route('profiles.show', ['user' => $comment->user])}}">{{ $comment->user->name }}</a></li>
    </ul>

@endsection
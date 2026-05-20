@extends('layouts.app')

@section('title', 'User details')

@section('content')
    <ul>
            <li>Name: {{ $user->name }}</li>
            <li>Email: {{ $user->email }}</li>
    </ul>
    <p>Posts:</p>
    @if (($user->posts) == "[]")
        <ul><li>{{ $user->name }} has no posts.</li></ul>
    @else
        @foreach ($user->posts as $post)
            <ul>
                <li><a href="{{route('posts.show', ['post' => $post])}}">{{$post->title}}</a></li>
            </ul>
        @endforeach
    @endif

    <p>Comments:</p>
    @if (($user->comments) == "[]")
        <ul><li>{{ $user->name }} has no comments.</li></ul>
    @else
        @foreach ($user->comments as $comment)
            <ul>
                <li><a href="{{route('posts.show', ['post' => $comment->post])}}">{{$comment->body}}</a></li>
            </ul>
        @endforeach
    @endif
@endsection
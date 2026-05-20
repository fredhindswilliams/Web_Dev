@extends('layouts.app')

@section('title', $user->name . "'s Profile")

@section('content')

    <p><strong>Bio:</strong> {{ $user->profile->bio ?? "No bio added yet." }}</p>

    @if($user->profile->avatar)
        <img src="{{ asset('storage/' . $user->profile->avatar->path) }}"  alt="{{$user->name}}'s Profile Picture" title="{{$user->name}}'s Profile Picture" width="100">
    @else
        <p><em>No avatar uploaded.</em></p>
    @endif

    @auth
        @if(Auth::id() === $user->id)
            <a href="{{ route('profiles.edit') }}">Edit Profile</a>
        @endif
    @endauth

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
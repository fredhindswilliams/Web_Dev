@extends('layouts.app')

@section('title', 'Comments')

@if (session('message'))
    <p><b>{{ session('message')}}</b></p>
@endif

@section('content')
    <p> All Comments: </p>
    <ul>
        @foreach ($comments as $comment)
            <li><a href="{{ route('comments.show', ['comment' => $comment])}}">{{$comment->body}}</a></li>
            <li>Author: <a href="{{ route('users.show', ['user' => $comment->user])}}">{{$comment->user->name}}</a></li>
            <br>
        @endforeach
    </ul>
@endsection
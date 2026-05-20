@extends('layouts.app')

@section('title', 'Welcome to the Hinds FC club site')

@section('content')
    <p class="font-bold">Below is a link to the forum where all posts can be found!</p>
    <li><a href="{{ route('posts.index')}}">Posts</a></li>
@endsection
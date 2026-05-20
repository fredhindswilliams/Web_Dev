@extends('layouts.app')

@section('title', 'Create post')

@section('content')
    <form method="POST" action="{{ route('users.store') }}">
        @csrf
        <p>Title: <input type="text" name="title" value="{{old('title')}}"></p>
        <p>Body: <input type="text" name="body" value="{{old('body')}}"></p>
        <input type="submit" name="Submit">
        <a href="{{ route('posts.index') }}">Cancel</a>
    </form>
@endsection
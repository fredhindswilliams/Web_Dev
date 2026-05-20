@extends('layouts.app')

@section('title', 'Users')

@if (session('message'))
    <p><b>{{ session('message')}}</b></p>
@endif

@section('content')
    <p> All users: </p>
    <ul>
        @foreach ($users as $user)
                <li><a href="{{ route('profiles.show', ['user' => $user])}}">{{$user->id}}: {{$user->name}}</a></li>
                <br>
        @endforeach
    </ul>
@endsection
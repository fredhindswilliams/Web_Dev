@extends('layouts.app')

@section('title', 'Login')

@section('content')
    <form action="/login" method="POST" class="flex flex-col gap-4">
    @csrf

    <label>Email</label>
    <input type="email" name="email" required>

    <label>Password</label>
    <input type="password" name="password" required>

    <button type="submit">Login</button>
    </form>

@endsection
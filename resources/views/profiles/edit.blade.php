@extends('layouts.app')

@section('title', 'Edit Profile')

@section('content')
    <h2>Edit Your Profile</h2>

    <form action="{{ route('profiles.update') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <label>Bio:</label><br>
        <textarea name="bio">{{ old('bio', $profile->bio) }}</textarea><br><br>

        <label>Avatar:</label><br>
        @if($profile->avatar)
            <img src="{{ asset('storage/' . $profile->avatar->path) }}" alt="{{$user->name}}'s Profile Picture" title="{{$user->name}}'s Profile Picture" width="100"><br>
        @endif

        <input type="file" name="avatar"><br><br>

        <button type="submit">Save</button>
    </form>
@endsection
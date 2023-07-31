@extends('master')

@section('content')

    <h2>Create</h2>

    @if (session()->has('message'))
        {{ session()->get('message') }}
    @endif

    <form enctype="multipart/form-data" method="post" action="{{ route('users.store') }}">
        @csrf
        <input type="text" name="name" placeholder="Your Name">
        <input type="text" name="email" placeholder="Your Email">
        <input type="text" name="password" placeholder="Your Password">
        <input type="text" name="remember_token" placeholder="Your Remember Token">
        <input type="file" name="photo" placeholder="Your Photo">

        <button type="submit">Create</button>
        <button type="" ><a href="{{ route('users.index') }}">Back</a></button>
    </form>

@endsection

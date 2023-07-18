@extends('master')

@section('content')

    <h2>Create</h2>

    @if (session()->has('message'))
        {{ session()->get('message') }}
    @endif

    <form  method="post" action="{{ route('users.store') }}">
        @csrf
        <input type="text" name="name" placeholder="Your Name">
        <input type="text" name="email" placeholder="Your Email">
        <input type="text" name="password" placeholder="Your Password">
        <input type="text" name="remember_token" placeholder="Your Remember Token">

        <button type="submit">Create</button>
        <button type="" ><a href="{{ route('users.index') }}">Voltar</a></button>
    </form>

@endsection

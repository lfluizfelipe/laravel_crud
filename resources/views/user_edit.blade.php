@extends('master')

@section('content')

    <h2>Edit</h2>

    @if (session()->has('message'))
        {{ session()->get('message') }}
    @endif

    <form method="post" action="{{ route('users.update', ['user'=> $user->id]) }}">
        @csrf
        <input type="hidden" name="_method" value="PUT">
        <label for="name">Nome:</label>
        <input type="text" name="name" value="{{ $user->name }}">
        <label for="email">Email:</label>
        <input type="text" name="email" value="{{ $user->email }}">

{{--        <img src="{{ asset($user->storage/app/photos) }}" alt="Imagem do usuário" width="100">--}}

        <button type="submit">Edit</button>
        <button type="" ><a href="{{ route('users.index') }}">Back</a></button>
    </form>

@endsection

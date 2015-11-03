@extends('layout')

@section('content')
    @if (count($errors) > 0)
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form method="POST" action="/auth/login">
        {!! csrf_field() !!}

        <div>
            Usuario
            <input type="text" name="username" value="{{ old('username') }}">
        </div>

        <div>
            Password
            <input type="password" name="password" id="password">
        </div>

        <div>
            <button type="submit">Login</button>
        </div>

        <div>
            <input type="checkbox" name="remember"> Remember Me
        </div>
    </form>
@endsection
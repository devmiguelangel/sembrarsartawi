@extends('layout')

@section('content')
    
    {!! Form::open() !!}
    {!! Field::text('name') !!}
    {!! Field::email('email') !!}
    {!! Field::password('password') !!}
    {!! Field::password('password_confirmation') !!}
    {!! Form::submit('Send', ['class' => 'btn btn-success']) !!}
    {!! Form::close() !!}

@endsection
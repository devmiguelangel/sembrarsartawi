@extends('layout')

@section('content')
    @if($errors->count() > 0)
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif
    <div class="container">
        {!! Form::open(['route' => 'de.store', 'method' => 'post']) !!}

        {!! Form::label('coverage', 'Tipo de Cobertura', []) !!}
        {!! SelectField::input('coverage', $coverages->toArray(), ['class' => 'form-control']) !!}
        <br>

        {!! Form::label('amount_requested', 'Monto Solicitado', []) !!}
        {!! Form::text('amount_requested', null, []) !!}
        {!! SelectField::input('currency', $currencies->toArray(), ['class' => 'form-control']) !!}
        <br>

        {!! Form::label('term', 'Plazo del Credito', []) !!}
        {!! Form::text('term', null, []) !!}
        {!! SelectField::input('type_term', $term_types->toArray(), ['class' => 'form-control']) !!}
        <br>

        {!! Form::submit('Enviar') !!}

        {!! Form::close() !!}
    </div>
@endsection
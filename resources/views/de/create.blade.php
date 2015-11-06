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
        {!! Form::select('coverage', $coverages) !!}
        <br>
        {!! Form::label('amount_requested', 'Monto Solicitado', []) !!}
        {!! Form::text('amount_requested', null, []) !!}
        {!! Form::select('currency', $currencies) !!}
        <br>
        {!! Form::label('term', 'Plazo del Credito', []) !!}
        {!! Form::text('term', null, []) !!}
        {!! Form::select('type_term', $term_types) !!}
        <br>

        {!! Form::submit('Enviar') !!}

        {!! Form::close() !!}
    </div>
@endsection
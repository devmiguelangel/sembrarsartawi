<div class="container">
    {!! Form::open(['route' => 'de.client.store', 'method' => 'post']) !!}

    {!! Form::hidden('header_id', request()->route('id')) !!}

    {!! Form::submit('Enviar') !!}

    {!! Form::close() !!}
</div>
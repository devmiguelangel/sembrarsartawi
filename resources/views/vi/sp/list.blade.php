@extends('layout')

@section('header')
    @include('partials.header-home')
@endsection

@section('menu-main')
    @include('partials.menu-main')
@endsection

@section('menu-header')
    <div class="page-header">
        <div class="page-header-content">
            <div class="page-title">
                <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Seguro de Desgravamen</span></h4>

                <ul class="breadcrumb breadcrumb-caret position-right">
                    <li><a href="">Inicio</a></li>
                    <li><a href="">Desgravamen</a></li>
                    <li class="active">Cotizar</li>
                </ul>
            </div>

        </div>
    </div>
@endsection

@section('content-wrapper')
    {!! Form::open(['route' => ['de.vi.sp.list.store', 'rp_id' => $rp_id, 'header_id' => $header_id], 'method' => 'post', 'class' => '']) !!}
        {!! Form::hidden('header_id', $header_id) !!}
        {!! Form::hidden('rp_id', encrypt($rp_id)) !!}
        <table class="table">
            <thead>
            <tr>
                <td></td>
                <td>CI</td>
                <td>Nombres</td>
                <td>Fecha de nacimiento</td>
                <td>Departamento</td>
            </tr>
            </thead>
            <tbody>
            @foreach($header->details as $key => $detail)
                <tr>
                    <td>
                        <input type="checkbox" name="client[{{ $key }}]" value="{{ encode($detail->client->id) }}">
                    </td>
                    <td>{{ $detail->client->dni }}</td>
                    <td>{{ $detail->client->full_name }}</td>
                    <td>{{ dateToFormat($detail->client->birthdate) }}</td>
                    <td>{{ $detail->client->birth_place }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="text-right">
            <a href="{{ route('de.issuance', ['rp_id' => $rp_id, 'header_id' => $header_id]) }}" class="btn border-slate text-slate-800 btn-flat">Cancelar</a>

            {!! Form::button('Continuar <i class="icon-arrow-right14 position-right"></i>', [
                'type' => 'submit',
                'class' => 'btn btn-primary'])
            !!}
        </div>
    {!! Form::close() !!}
@endsection
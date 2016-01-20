@extends('admin.layout')

@section('menu-user')
    @include('admin.partials.menu-user')
@endsection

@section('menu-main')
    @include('admin.partials.menu-main')
@endsection

@section('header')
    @include('admin.partials.header')
    @include('admin.partials.message')
@endsection

@section('content')
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title"> <i class="icon-list"></i> Certificados</h5>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li>
                        <a href="{{route('mcCertificatesFormNew')}}" class="btn btn-link btn-float has-text">
                            <i class="icon-plus2"></i>
                            <span>Nuevo</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <hr />
        <div class="panel-body ">
            <table class="table datatable-basic">
                <thead>
                    <tr>
                        <th>Id retailer prodcuto</th>
                        <th>Tipo</th>
                        <th>Nombre Certificado</th>
                        <th>Activo</th>
                        <th>Asignación Questionarios</th>
                        <th>Asignación Preguntas</th>
                        <th class="text-center">Acción</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($entities as $entity)
                    <tr>
                        <td>
                            <a href="{{ route('mcCertificatesFormEdit', ['id'=>$entity->id ]) }}" title="{{ $entity->name_product }}">
                            {{ $entity->name_product }}
                            </a>
                        </td>
                        <td>
                            <strong>{{ $type[$entity->type] }}</strong>
                        </td>
                        <td>{{ $entity->name }}</td>
                        <td>
                            @if($entity->active == 1)
                                <i class="glyphicon glyphicon-chevron-down"></i>
                            @else
                                <i class="glyphicon glyphicon-remove"></i>
                            @endif
                        </td>
                        <td class="text-center">
                            @if($entity->questionnaire == 0)
                                <a href="{{ route('mcCertificatesMcCuestionariesForm',['id'=>$entity->id]) }}"><span class="label label-success">Asignar</span></a>
                            @else
                                <a href="{{ route('mcCertificatesMcCuestionariesFormEdit',['id'=>$entity->id]) }}"><span class="label label-info">Editar</span></a>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('mcCertificateCuestionnairesList',['id_cert'=>$entity->id]) }}">Asignar</a>
                        </td>
                        <td class="text-center">
                            <a onclick="FormGralF.deleteElement('{{ route('mcCertificatesFormDestroy', ['id'=>$entity->id ]) }}','')" title="Eliminar"><i class="icon-trash"></i></a>&nbsp;
                            <a href="{{ route('mcCertificatesFormEdit', ['id'=>$entity->id ]) }}" title="Editar"><i class="icon-pencil"></i></a>&nbsp;
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <hr />
        </div>
    </div>
@endsection
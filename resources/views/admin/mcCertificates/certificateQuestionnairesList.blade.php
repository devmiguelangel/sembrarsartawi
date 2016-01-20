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
            <h5 class="panel-title"> <i class="icon-list"></i> Asignación de Prequntas - {{ $mcCertificates->name }}</h5>
        </div>
        <hr />
        <div class="panel-body ">
            <table class="table datatable-basic">
                <thead>
                    <tr>
                        <th>Questionario</th>
                        <th>Activo</th>
                        <th class="text-center">Acción</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($mcCertificateQuestionnaires as $entity)
                    <tr>
                        <td>
                            <a href="" title="{{ $entity->title_cuestionnaire }}">
                            {{ $entity->title_cuestionnaire }}
                            </a>
                        </td>
                        <td>
                            @if($entity->active == 1)
                                <i class="glyphicon glyphicon-chevron-down"></i>
                            @else
                                <i class="glyphicon glyphicon-remove"></i>
                            @endif
                        </td>
                        <td class="text-center">
                            <a href="{{ route('mcCertificateCuestionnairesNewForm',['id'=>$entity->mc_questionnaire_id]) }}"><span class="label label-success">Asignar</span></a>
                            <a href="{{ route('mcCertificatesMcCuestionariesFormEdit',['id'=>$entity->id]) }}"><span class="label label-info">Editar</span></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <hr />
        </div>
    </div>
@endsection
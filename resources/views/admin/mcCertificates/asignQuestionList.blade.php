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
            <h5 class="panel-title"> <i class="icon-list"></i> Asignación de Preguntas - {{ $mcCertificates->name }}</h5>
        </div>
        <hr />
        <div class="panel-body ">
            <table class="table datatable-basic">
                <thead>
                    <tr>
                        <th>Questionario</th>
                        <th>Activo</th>
                        <th class="text-center">Asignacion de Preguntas</th>
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
                            @if($entity->asign == 0)
                                <a href="{{ route('asignQuestionNewForm',['id_questionnaire'=>$entity->mc_questionnaire_id, 'id_cert'=>$mcCertificates->id, 'id_cert_quest' => $entity->id]) }}"><span class="label label-success"><i class="icon-plus2"></i> Asignar</span></a>
                            @else
                            <a href="{{ route('asignQuestionEditForm',['id_questionnaire'=>$entity->mc_questionnaire_id, 'id_cert'=>$mcCertificates->id, 'id_cert_quest' => $entity->id]) }}"><span class="label label-info"><i class="icon-pencil"></i> Editar</span></a>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <hr />
            <div class="text-right">
                <a href="{{ route('mcCertificatesList') }}" class="btn btn-primary" title="Volver a Lista de Certificados">
                    Volver a Lista de Certificados <i class="icon-arrow-right14"></i>
                </a>
            </div>
        </div>
    </div>
@endsection
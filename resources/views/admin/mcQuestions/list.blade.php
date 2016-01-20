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
            <h5 class="panel-title"> <i class="icon-list"></i> Preguntas</h5>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li>
                        <a href="{{route('mcQuestionsFormNew')}}" class="btn btn-link btn-float has-text">
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
                        <th>Pregunta</th>
                        <th>Tipo</th>
                        <th class="text-center">Acción</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($entities as $entity)
                    <tr>
                        <td>
                            <a href="{{ route('mcQuestionsFormEdit', ['id'=>$entity->id ]) }}" title="{{ $entity->question }}">
                            {{ $entity->question }}
                            </a>
                        </td>
                        <td>{{ $tipoCampo[$entity->type] }}</td>
                        <td class="text-center">
                            <a onclick="FormGralF.deleteElement('{{ route('mcQuestionsFormDestroy', ['id'=>$entity->id ]) }}','')" title="Eliminar"><i class="icon-trash"></i></a>&nbsp;
                            <a href="{{ route('mcQuestionsFormEdit', ['id'=>$entity->id ]) }}" title="Editar"><i class="icon-pencil"></i></a>&nbsp;
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <hr />
            
        </div>
    </div>
@endsection
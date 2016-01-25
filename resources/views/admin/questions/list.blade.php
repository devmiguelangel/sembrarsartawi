@extends('admin.layout')

@section('menu-user')
    @include('admin.partials.menu-user')
@endsection

@section('menu-main')
    @include('admin.partials.menu-main')
@endsection

@section('header')
    @include('admin.partials.header')
@endsection

@section('content')
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="form-wizard-title text-semibold" style="border-bottom: 0px;">
                <span class="form-wizard-count"><i class="icon-file-text2"></i></span>
                Preguntas
                <small class="display-block">Listado de registros</small>
            </h5>
            <div class="heading-elements">

                <ul class="icons-list">
                    <li>
                        <a href="{{route('admin.questions.new', ['nav'=>'question', 'action'=>'new', 'id_retailer_product'=>0, 'code_product'=>'nn'])}}" class="btn btn-link btn-float has-text">
                            <i class="icon-file-plus text-primary"></i>
                            <span>Crear pregunta</span>
                        </a>
                    </li>
                </ul>

            </div>
        </div>

        <div class="panel-body">

        </div>

        <table class="table datatable-basic">
            <thead>
            <tr>
                <th style="text-align: left;">Nro</th>
                <th style="text-align: left;">Pregunta</th>
                <th class="text-center">Acción</th>
            </tr>
            </thead>
            <tbody>
            @var $j=0
            @foreach($query as $data)
                @var $j=$j+1
                <tr>
                    <td style="text-align: left;">{{$j}}</td>
                    <td style="text-align: left;">{{$data->question}}</td>
                    <td class="text-center">
                        <ul class="icons-list">
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="icon-menu9"></i>
                                </a>

                                <ul class="dropdown-menu dropdown-menu-right">
                                    <li>
                                        <a href="{{route('admin.questions.edit', ['nav'=>'question', 'action'=>'edit', 'id_question'=>$data->id])}}">
                                            <i class="icon-pencil3"></i> Editar pregunta
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
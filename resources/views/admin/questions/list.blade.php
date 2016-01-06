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
            <h5 class="panel-title">&nbsp;</h5>
            <div class="heading-elements">

                <ul class="icons-list">
                    <li>
                        <a href="{{route('admin.questions.new', ['nav'=>'question', 'action'=>'new'])}}" class="btn btn-link btn-float has-text">
                            <i class="icon-calendar5 text-primary"></i>
                            <span>Agregar pregunta</span>
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
                <th>Nro</th>
                <th>Pregunta</th>
                <th class="text-center">Acción</th>
            </tr>
            </thead>
            <tbody>
            @var $j=0
            @foreach($query as $data)
                @var $j=$j+1
                <tr>
                    <td>{{$j}}</td>
                    <td>{{$data->question}}</td>
                    <td class="text-center">
                        <ul class="icons-list">
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="icon-menu9"></i>
                                </a>

                                <ul class="dropdown-menu dropdown-menu-right">
                                    <li>
                                        <a href="{{route('admin.questions.edit', ['nav'=>'question', 'action'=>'edit', 'id_question'=>$data->id])}}">
                                            <i class="icon-file-excel"></i> Editar pregunta
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
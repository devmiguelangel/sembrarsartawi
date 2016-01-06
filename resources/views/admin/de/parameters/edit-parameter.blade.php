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
            <h5 class="panel-title">Formulario editar parametros</h5>
            <div class="heading-elements">
                <ul class="icons-list">

                    <li><a data-action="reload"></a></li>

                </ul>
            </div>
        </div>

        <div class="panel-body">
            @foreach($query as $data)

                {!! Form::open(array('route' => 'update_parameter', 'name' => 'paramUpdateForm', 'id' => 'paramUpdateForm', 'method'=>'post', 'class'=>'form-horizontal')) !!}
                    <fieldset class="content-group">

                        <div class="form-group">
                            <label class="control-label col-lg-2">Facturación</label>
                            <label class="radio-inline">
                                @if((boolean)$data->billing == true)
                                    <input type="radio" name="fact" class="styled" checked="checked" value="1">SI
                                @else
                                    <input type="radio" name="fact" class="styled" value="1">SI
                                @endif
                            </label>
                            <label class="radio-inline">
                                @if((boolean)$data->billing == false)
                                    <input type="radio" name="fact" class="styled" checked="checked" value="0">NO
                                @else
                                    <input type="radio" name="fact" class="styled" value="0">NO
                                @endif
                            </label>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-lg-2">Certificado Provisional</label>
                            <label class="radio-inline">
                                @if((boolean)$data->provisional_certificate==true)
                                    <input type="radio" name="cert" class="styled" checked="checked" value="1">SI
                                @else
                                    <input type="radio" name="cert" class="styled" value="1">SI
                                @endif
                            </label>

                            <label class="radio-inline">
                                @if((boolean)$data->provisional_certificate==false)
                                    <input type="radio" name="cert" class="styled" checked="checked" value="0">NO
                                @else
                                    <input type="radio" name="cert" class="styled" value="0">NO
                                @endif
                            </label>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-lg-2">Modalidad</label>
                            <label class="radio-inline">
                                @if((boolean)$data->modality==true)
                                    <input type="radio" name="moda" class="styled" checked="checked" value="1">SI
                                @else
                                    <input type="radio" name="moda" class="styled" value="1">SI
                                @endif
                            </label>

                            <label class="radio-inline">
                                @if((boolean)$data->modality==false)
                                    <input type="radio" name="moda" class="styled" checked="checked" value="0">NO
                                @else
                                    <input type="radio" name="moda" class="styled" value="0">NO
                                @endif
                            </label>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-lg-2">Facultativo</label>
                            <label class="radio-inline">
                                @if((boolean)$data->facultative==true)
                                    <input type="radio" name="facu" class="styled" checked="checked" value="1">SI
                                @else
                                    <input type="radio" name="facu" class="styled" value="1">SI
                                @endif
                            </label>

                            <label class="radio-inline">
                                @if((boolean)$data->facultative==false)
                                    <input type="radio" name="facu" class="styled" checked="checked" value="0">NO
                                @else
                                    <input type="radio" name="facu" class="styled" value="0">NO
                                @endif
                            </label>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-lg-2">Web Service</label>
                            <label class="radio-inline">
                                @if((boolean)$data->ws==true)
                                    <input type="radio" name="webs" class="styled" checked="checked" value="1">SI
                                @else
                                    <input type="radio" name="webs" class="styled" value="1">SI
                                @endif
                            </label>

                            <label class="radio-inline">
                                @if((boolean)$data->ws==false)
                                    <input type="radio" name="webs" class="styled" checked="checked" value="0">NO
                                @else
                                    <input type="radio" name="webs" class="styled" value="0">NO
                                @endif
                            </label>
                        </div>

                    </fieldset>

                    <div class="text-right">
                        <button type="submit" class="btn btn-primary">
                            Guardar <i class="icon-arrow-right14 position-right"></i>
                        </button>
                        <a href="{{ route('admin.de.parameters.list-parameter', ['nav'=>'de', 'action'=>'list_parameter', 'id_retailer'=>$data->ad_retailer_id]) }}" class="btn btn-primary">
                            Cancelar <i class="icon-arrow-right14 position-right"></i>
                        </a>
                        <input type="hidden" name="id_retailer_product" value="{{$id_retailer_product}}">
                        <input type="hidden" name="ad_retailer_id" value="{{$data->ad_retailer_id}}">
                    </div>
                {!!Form::close()!!}

            @endforeach
        </div>
    </div>
@endsection
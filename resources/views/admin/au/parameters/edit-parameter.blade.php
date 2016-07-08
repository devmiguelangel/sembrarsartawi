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
                <span class="form-wizard-count">
                    <i class="icon-pencil7"></i>
                </span>
                Formulario producto {{$query->producto}}
                <small class="display-block">Editar registro </small>
            </h5>
            <div class="heading-elements">
                <!--
                <ul class="icons-list">

                    <li><a data-action="reload"></a></li>

                </ul>
                -->
            </div>
        </div>

        <div class="panel-body">

            {!! Form::open(array('route' => 'update_au_parameter', 'name' => 'UpdateForm', 'id' => 'UpdateForm', 'method'=>'post', 'class'=>'form-horizontal')) !!}
            <fieldset class="content-group">

                <div class="form-group">
                    <label class="control-label col-lg-2">Facturación</label>
                    <label class="radio-inline">
                        @if((boolean)$query->billing == true)
                            <input type="radio" name="fact" class="styled" checked="checked" value="1">SI
                        @else
                            <input type="radio" name="fact" class="styled" value="1">SI
                        @endif
                    </label>
                    <label class="radio-inline">
                        @if((boolean)$query->billing == false)
                            <input type="radio" name="fact" class="styled" checked="checked" value="0">NO
                        @else
                            <input type="radio" name="fact" class="styled" value="0">NO
                        @endif
                    </label>
                </div>

                <div class="form-group">
                    <label class="control-label col-lg-2">Certificado Provisional</label>
                    <label class="radio-inline">
                        @if((boolean)$query->provisional_certificate==true)
                            <input type="radio" name="cert" class="styled" checked="checked" value="1">SI
                        @else
                            <input type="radio" name="cert" class="styled" value="1">SI
                        @endif
                    </label>

                    <label class="radio-inline">
                        @if((boolean)$query->provisional_certificate==false)
                            <input type="radio" name="cert" class="styled" checked="checked" value="0">NO
                        @else
                            <input type="radio" name="cert" class="styled" value="0">NO
                        @endif
                    </label>
                </div>

                <div class="form-group">
                    <label class="control-label col-lg-2">Modalidad</label>
                    <label class="radio-inline">
                        @if((boolean)$query->modality==true)
                            <input type="radio" name="moda" class="styled" checked="checked" value="1">SI
                        @else
                            <input type="radio" name="moda" class="styled" value="1">SI
                        @endif
                    </label>

                    <label class="radio-inline">
                        @if((boolean)$query->modality==false)
                            <input type="radio" name="moda" class="styled" checked="checked" value="0">NO
                        @else
                            <input type="radio" name="moda" class="styled" value="0">NO
                        @endif
                    </label>
                </div>

                <div class="form-group">
                    <label class="control-label col-lg-2">Garantia</label>
                    <label class="radio-inline">
                        @if((boolean)$query->warranty==true)
                            <input type="radio" name="warr" class="styled" checked="checked" value="1">SI
                        @else
                            <input type="radio" name="warr" class="styled" value="1">SI
                        @endif
                    </label>

                    <label class="radio-inline">
                        @if((boolean)$query->warranty==false)
                            <input type="radio" name="warr" class="styled" checked="checked" value="0">NO
                        @else
                            <input type="radio" name="warr" class="styled" value="0">NO
                        @endif
                    </label>
                </div>

                <div class="form-group">
                    <label class="control-label col-lg-2">Facultativo</label>
                    <label class="radio-inline">
                        @if((boolean)$query->facultative==true)
                            <input type="radio" name="facu" class="styled" checked="checked" value="1">SI
                        @else
                            <input type="radio" name="facu" class="styled" value="1">SI
                        @endif
                    </label>

                    <label class="radio-inline">
                        @if((boolean)$query->facultative==false)
                            <input type="radio" name="facu" class="styled" checked="checked" value="0">NO
                        @else
                            <input type="radio" name="facu" class="styled" value="0">NO
                        @endif
                    </label>
                </div>

                <div class="form-group">
                    <label class="control-label col-lg-2">Web Service</label>
                    <label class="radio-inline">
                        @if((boolean)$query->ws==true)
                            <input type="radio" name="webs" class="styled" checked="checked" value="1">SI
                        @else
                            <input type="radio" name="webs" class="styled" value="1">SI
                        @endif
                    </label>

                    <label class="radio-inline">
                        @if((boolean)$query->ws==false)
                            <input type="radio" name="webs" class="styled" checked="checked" value="0">NO
                        @else
                            <input type="radio" name="webs" class="styled" value="0">NO
                        @endif
                    </label>
                </div>

            </fieldset>

            <div class="text-right">
                <button type="submit" class="btn btn-primary">
                    Guardar <i class="icon-floppy-disk position-right"></i>
                </button>
                <a href="{{ route('admin.au.parameters.list-parameter', ['nav'=>'au_parameter', 'action'=>'list_parameter', 'id_retailer_product'=>$id_retailer_product]) }}" class="btn btn-primary">
                    Cancelar <i class="icon-cross position-right"></i>
                </a>
                <input type="hidden" name="id_retailer_product" value="{{$id_retailer_product}}">
                <input type="hidden" name="ad_retailer_id" value="{{$query->ad_retailer_id}}">
            </div>
            {!!Form::close()!!}

        </div>
    </div>
@endsection
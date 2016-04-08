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
            <h5 class="panel-title"><i class="icon-plus2"></i> Modificación </h5>
            <hr />
        </div>

        <div class="panel-body">

            {!! Form::open(array('route' => ['update_vehicle_type'], 'name' => 'Form', 'id' => 'ad_vehicle_type', 'method'=>'post', 'class'=>'form-horizontal form-validate-jquery')) !!}
            <fieldset class="content-group">
                <div class="form-group">
                    <label class="control-label col-lg-2 label_required">Vehículo</label>
                    <div class="col-lg-5">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="icon-text-width"></i></span>
                            <input type="hidden" value="{{ $entity->id }}" name="id_vehicle_type" id="id_vehicle_type">
                            <input type="text" value="{{ $entity->vehicle }}" placeholder="Vehículo" class="form-control" name="vehicle" id="vehicle" required="required">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-lg-2">Categoría</label>
                    <div class="col-lg-5">
                        <select class="form-control" name="ad_retailer_product_category_id" id="ad_retailer_product_category_id">
                            <option value="">Ninguno</option>
                            @foreach($category as $categories)
                                @if($entity->ad_retailer_product_category_id == $categories->id)
                                <option value="{{ $categories->id }}" selected>{{ $categories->category_name }}</option>
                                @else    
                                    <option value="{{ $categories->id }}">{{ $categories->category_name }}</option>
                                @endif    
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-lg-2 label_required">Porcentaje</label>
                    <div class="col-lg-5">
                        <div class="input-group">
                            <span class="input-group-addon">%</span>
                            <input type="text" value="{{ $entity->percentage }}" placeholder="Porcentaje" class="form-control" name="percentage" id="percentage" required="required">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-lg-2 label_required">Activar</label>
                    <div class="col-lg-5">
                        @if($entity->active == 1)
                        <input type="checkbox" class="styled tipode" name="active" id="active" checked="checked">
                        @else
                            <input type="checkbox" class="styled tipode" name="active" id="active">
                        @endif
                    </div>
                </div>
            </fieldset>

                <div class="text-right">
                    <button type="submit" class="btn btn-primary">
                        Guardar <i class="icon-floppy-disk position-right"></i>
                    </button>
                    <a href="{{route('admin.vehicle.list', ['nav'=>'ad_vehicle_types', 'action'=>'list'])}}" class="btn btn-danger">
                        Cancelar <i class="icon-arrow-right14 position-right"></i>
                    </a>
                </div>
            {!!Form::close()!!}

        </div>
    </div>
@endsection
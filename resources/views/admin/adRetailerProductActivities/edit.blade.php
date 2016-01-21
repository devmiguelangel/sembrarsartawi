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
            <h5 class="panel-title"><i class="icon-plus2"></i> Nueva Asignación</h5>
            <hr />
        </div>

        <div class="panel-body">
            

            {!! Form::open(array('route' => ['update_ad_retailer_product_activities','id'=>$adRetailerProductId], 'name' => 'Form', 'id' => 'ad_retailer_product_activities', 'method'=>'post', 'class'=>'form-horizontal form-validate-jquery')) !!}
                <fieldset class="content-group">
                    <div class="form-group">
                        <label class="control-label col-lg-2 label_required">Producto</label>
                        <div class="col-lg-5">
                            <select disabled="disabled" class="form-control" name="combo" id="combo" required="required">
                                <option value="">Seleccione</option>
                                @foreach($retailerProducts as $products)
                                    @if($adRetailerProductId == $products->id)
                                        <option value="{{ $products->id }}" selected>{{ $products->name }}</option>
                                    @else
                                        <option value="{{ $products->id }}">{{ $products->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <input type="hidden" name="adRetailerProductActivities" id="adRetailerProductActivities" value="{{ $adRetailerProductId }}">
                    <div class="form-group">
                        <label class="control-label col-lg-2 label_required">Multiple select</label>
                        <div class="col-lg-5">
                            <select class="form-control" multiple="multiple" id="adActivities" name="adActivities[]" required="required">
                                @foreach($activities as $activity)
                                        @if($activity->selected == 1)
                                            <option value="{{ $activity->id }}" selected="selected">{{ $activity->occupation }}</option>      
                                        @else
                                            <option value="{{ $activity->id }}" >{{ $activity->occupation }}</option>      
                                        @endif
                                @endforeach
                            </select>
                        </div>
                    </div>

                </fieldset>

                <div class="text-right">
                    <button type="submit" class="btn btn-primary">
                        Guardar <i class="icon-floppy-disk position-right"></i>
                    </button>
                    <a href="{{ route('adRetailerProductActivities') }}" class="btn btn-danger">
                        Cancelar <i class="icon-arrow-right14 position-right"></i>
                    </a>
                </div>
            {!!Form::close()!!}

        </div>
    </div>
@endsection
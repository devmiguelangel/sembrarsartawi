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
                    <i class="icon-pencil6"></i>
                </span>
                Formulario
                <small class="display-block">Agregar departamento a Retailer</small>
            </h5>
            <div class="heading-elements">

            </div>
        </div>
        @if (session('error'))
            <div class="alert alert-danger alert-styled-left alert-bordered">
                <span class="text-semibold">Error!</span> {{ session('error') }}
            </div>
        @endif
        <div class="panel-body">

            {!! Form::open(array('route' => 'add_city_retailer', 'name' => 'CreateForm', 'id' => 'CreateForm', 'method'=>'post', 'class'=>'form-horizontal')) !!}

                <fieldset class="content-group">

                    <div class="form-group">
                        <label class="control-label col-lg-2">Retailer</label>
                        <div class="col-lg-10">
                            <select name="id_retailer" id="id_retailer" class="form-control">
                                <option value="0">Seleccione</option>
                                @foreach($retailer as $dat_ret)
                                    <option value="{{$dat_ret->id}}">{{$dat_ret->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-lg-2">Departamentos</label>
                        <div class="col-lg-10">
                            <select multiple="multiple" name="city[]" id="id_city" class="form-control" disabled>
                                @foreach($city as $dat_city)
                                <option value="{{$dat_city->id}}">{{$dat_city->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </fieldset>

                <div class="text-right">
                    <button type="submit" class="btn btn-primary">
                        Guardar <i class="icon-floppy-disk position-right"></i>
                    </button>
                    <a href="{{route('admin.cities.list-city-retailer', ['nav'=>'city', 'action'=>'list_city_retailer'])}}" class="btn btn-primary">
                        Cancelar <i class="icon-cross position-right"></i>
                    </a>
                </div>
            {!!Form::close()!!}
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function(){
            //VISUALIZAR DEPARTAMENTOS Y FERIFICAR SI ESTAN ADICIONADOS A UN RETAILER
            $('#id_retailer').change(function(e){
                var id_retailer = $(this).prop('value');
                alert(id_retailer);
                if(id_retailer!=0){
                    var cities;
                    var cities_retailer;
                    var sw=0;
                    $('#id_city').prop('disabled',false);
                    $.get( "{{url('/')}}/admin/cities/retailer_city_ajax/"+id_retailer, function( json ) {
                        console.log(json);

                        $('#id_city option').remove();
                        $.each(json, function (key, data) {
                            console.log(key)
                            if(key=='city'){
                                cities = data;
                            }else if(key=='cityretailer'){
                                cities_retailer = data;
                            }
                        });
                        $.each(cities, function () {
                            console.log("ID: " + this.id_city);
                            console.log("Profiles: " + this.cities);
                            var id_city = this.id_city;
                            var cities = this.cities;
                            $.each(cities_retailer, function () {
                                var ad_city_id = this.ad_city_id;
                                if(id_city==ad_city_id){
                                    $('#id_city').append('<option value="'+id_city+'" selected>'+cities+'</option>');
                                    sw=id_city;
                                }
                            });
                            if(id_city!=sw){
                                $('#id_city').append('<option value="'+id_city+'">'+cities+'</option>');
                            }
                        });

                    });
                }else{
                    $("#id_city option:selected").removeAttr("selected");
                    $('#id_city').prop('disabled',true);
                }

            });
        });
    </script>
@endsection
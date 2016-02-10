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
                <small class="display-block">Agregar agencia a departamento</small>
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

            {!! Form::open(array('route' => 'add_agency_retailer', 'name' => 'CreateForm', 'id' => 'CreateForm', 'method'=>'post', 'class'=>'form-horizontal')) !!}

            <fieldset class="content-group">

                <div class="form-group">
                    <label class="control-label col-lg-2">Retailer</label>
                    <div class="col-lg-10">
                        <select name="id_retailer" id="id_retailer" class="form-control">
                            <option value="0">Seleccione</option>
                            @foreach($retailer as $dat_ret)
                                <option value="{{$dat_ret->id_retailer}}">{{$dat_ret->retailer}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-lg-2">Departamento</label>
                    <div class="col-lg-10">
                        <select name="id_retailer_cities" id="id_retailer_cities" class="form-control" disabled>
                            <option value="0">Seleccione</option>
                        </select>
                        <div id="msg_city"></div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-lg-2">Agencias</label>
                    <div class="col-lg-10">
                        <select multiple="multiple" name="agencies[]" id="id_agency" class="form-control" disabled>
                            @foreach($agency as $dat_agency)
                                <option value="{{$dat_agency->id_agency}}">{{$dat_agency->agency}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </fieldset>

            <div class="text-right">
                <button type="submit" class="btn btn-primary">
                    Guardar <i class="icon-floppy-disk position-right"></i>
                </button>
                <a href="{{route('admin.agencies.list-agency-retailer', ['nav'=>'agency', 'action'=>'list_agency_retailer'])}}" class="btn btn-primary">
                    Cancelar <i class="icon-cross position-right"></i>
                </a>
            </div>
            {!!Form::close()!!}
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function(){
            //VISUALIZAR DEPARTAMENTO RETAILER
            $('#id_retailer').change(function(e){
                var id_retailer = $(this).prop('value');
                alert(id_retailer);
                if(id_retailer!=0){
                    $.get( "{{url('/')}}/admin/agencies/cities_ajax/"+id_retailer, function( data ) {
                        console.log(data);
                        $('#id_retailer_cities').prop('disabled',false);
                        $('#id_retailer_cities option').remove();
                        $('#id_retailer_cities').append('<option value="0">Seleccione</option>');
                        if(data.length>0) {
                            $('#msg_city').html('');
                            $.each(data, function () {
                                console.log("ID: " + this.id_retailer_city);
                                console.log("First Name: " + this.cities);
                                $('#id_retailer_cities').append('<option value="'+this.id_retailer_city+'">'+this.cities+'</option>');
                            });
                        }else{
                            $('#msg_city').html('<div class="alert alert-warning alert-styled-left"><span class="text-semibold">Warning!</span> No existen departamentos agregados al retailer.</div>');
                        }

                    });
                }else{

                }
            });

            //VISUALIZAR AGENCIAS AGREGADAS AL DEPARTAMENTO
            $('#id_retailer_cities').change(function(e){
                var id_retailer_city = $(this).prop('value');
                alert(id_retailer_city);

                if(id_retailer!=0){
                    var agencies;
                    var retailer_city_agencies;
                    var sw=0;
                    $('#id_agency').prop('disabled',false);
                    $.get( "{{url('/')}}/admin/agencies/retailer_agencies_ajax/"+id_retailer_city, function( json ) {
                        console.log(json);

                        $('#id_agency option').remove();
                        $.each(json, function (key, data) {
                            console.log(key)
                            if(key=='retcityagency'){
                                retailer_city_agencies = data;
                            }else if(key=='agenciestable'){
                                agencies = data;
                            }
                        });
                        $.each(agencies, function () {
                            console.log("ID: " + this.id_agency);
                            console.log("Profiles: " + this.agencies);
                            var id_agency = this.id_agency;
                            var agencies = this.agencies;
                            $.each(retailer_city_agencies, function () {
                                var ad_agency_id = this.ad_agency_id;
                                if(id_agency==ad_agency_id){
                                    $('#id_agency').append('<option value="'+id_agency+'" selected>'+agencies+'</option>');
                                    sw=id_agency;
                                }
                            });
                            if(id_agency!=sw){
                                $('#id_agency').append('<option value="'+id_agency+'">'+agencies+'</option>');
                            }
                        });

                    });
                }else{
                    $("#id_agency option:selected").removeAttr("selected");
                    $('#id_agency').prop('disabled',true);
                }

            });

        });
    </script>
@endsection
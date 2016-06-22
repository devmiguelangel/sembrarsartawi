<div class="row">
    <div class="col-md-12">
        <!-- Horizontal form -->
        <div class="panel panel-flat border-top-primary">
            @if(! request()->has('coverage'))
                <div class="panel-heading divhr">
                    <h6 class="form-wizard-title2 text-semibold">
                    <span class="col-md-11">
                        <span class="form-wizard-count">4</span>
                        Datos del Riesgo Asegurado
                    </span>
                    </h6>
                </div>
            @endif

            {!! Form::open(['route' => ['td.pr.i.update',
                'rp_id'     => $rp_id,
                'header_id' => $header_id,
                'detail_id' => $detail_id,
            ],
                'method'        => 'put',
                'class'         => 'form-horizontal',
                'ng-controller' => 'DetailTdController',
                'ng-submit'     => 'updateIssuance($event)',
            ]) !!}

            <div class="panel-body ">
                @include('td.partials.property-edit')

                @if(request()->has('coverage'))
                    <input type="hidden" ng-init="formData.coverage='{{ request()->get("coverage") }}'">
                @endif

                <div class="text-right">
                    <button type="button" class="btn border-slate text-slate-800 btn-flat" data-dismiss="modal">
                        Cancelar
                    </button>

                    <button type="submit" class="btn btn-primary">
                        @if(request()->has('coverage'))
                            Continuar
                        @else
                            Actualizar Riesgo Asegurado
                        @endif
                        <i class="icon-arrow-right14 position-right"></i>
                    </button>
                </div>
            </div>
            {!! Form::close() !!}

        </div>
        <script type="text/javascript">
            $(document).ready(function () {
                $("select.select-search").select2({
                    dropdownParent: "#popup"
                });
            });
        </script>
        <!-- /horizotal form -->
    </div>
</div>
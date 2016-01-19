<!-- template ensajes de sitio-->

@if(session('edit'))
    <div class="alert alert-primary no-border">
        <button data-dismiss="alert" class="close" type="button"><span>×</span><span class="sr-only">Cerrar</span></button>
        <span class="text-semibold">Exito!</span> Registro Actualizado Correctamente.
    </div>
@endif
@if(session('delete'))
    <div class="alert alert-danger no-border">
        <button data-dismiss="alert" class="close" type="button"><span>×</span><span class="sr-only">Cerrar</span></button>
        <span class="text-semibold">Exito!</span> Registro Eliminado Correctamente.
    </div>
@endif
@if(session('new'))
    <div class="alert alert-success no-border">
        <button data-dismiss="alert" class="close" type="button"><span>×</span><span class="sr-only">Cerrar</span></button>
        <span class="text-semibold">Exito!</span> Registro Realizado Correctamente.
    </div>
@endif

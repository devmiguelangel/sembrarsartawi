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

@if(session('ok'))
    <div class="alert alert-success alert-styled-left alert-arrow-left alert-bordered" id="message-session">
        <button type="button" class="close" data-dismiss="alert"><span>&times;</span><span class="sr-only">Close</span></button>
        <span class="text-semibold"></span> {{session('ok')}}
    </div>
@endif
@if(session('error'))
    <div class="alert alert-danger alert-styled-left alert-bordered">
        <button data-dismiss="alert" class="close" type="button"><span>×</span><span class="sr-only">Close</span></button>
        <span class="text-semibold">Error!</span> {{session('error')}}
    </div>
@endif


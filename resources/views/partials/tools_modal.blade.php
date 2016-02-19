<div class="col-md-12">
    <a href="{{ route('sleepModalPdf', ['type'=>$type, 'idHeader'=>$idHeader])}}" target="_blanck">
        <i class="fa fa-file-pdf-o fa-3x text-primary"></i>
    </a>
    &nbsp;&nbsp;
    <a id="printer" href="javascript:printSelec('respuesta')" onclick="$('#finish').removeClass('current');$('#finish').addClass('first');$('#finish').addClass('done');">
        <i class="fa fa-print fa-3x text-success"></i> 
    </a>
</div>
<hr />
<br />
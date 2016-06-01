@if($type=='IMPR')
    <a href="javascript:void(0)" class="link-cert" rel="print" id="send-print" title="Imprimir">
        <i class="fa fa-print fa-3x text-success"></i>
    </a>
    &nbsp;&nbsp;
    <a href="{{ route('import_pdf', ['id_retailer_product'=>$id_retailer_product, 'id_header'=>$id_header, 'text'=>$text, 'type'=>'PDF']) }}" class="link-cert" target="_blank" title="Generar pdf">
        <i class="fa fa-file-pdf-o fa-3x text-primary"></i>
    </a>
    <hr/>
@endif

<div class="print">
    @if($text=='slip')
        @include('cert.td.certificate_slip')
    @elseif($text=='issuance')
        @include('cert.td.certificate_issuance')
    @elseif($text=='print_all')
        @include('cert.td.certificate_slip')
        <page><div style="page-break-before: always;">&nbsp;</div></page>
        @include('cert.td.certificate_issuance')
    @endif
</div>

<style type="text/css">
    @page { margin: 0px; }
</style>

<script type="text/javascript">
    $(document).ready(function(){
        $('#send-print').click(function(){
            $('#finish').removeClass('current');
            $('#finish').addClass('first done');
            var rel = $(this).prop('rel');
            $("div."+rel).printArea();
        });
    });
</script>
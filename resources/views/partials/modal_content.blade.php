<div id="prueba_modal" class="modal fade">
    <div class="modal-dialog" style="width: 825px;">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h6 class="modal-title main-title"></h6>
            </div>
            <div class="modal-body" id="respuesta">
                <p>One fine body&hellip;</p>
            </div>
            <hr />
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        $('a[href].open_modal').click(function(e){
            e.preventDefault();
            var href = $(this).prop('href');
            var id = $(this).prop('id');
            if(id=='slip'){
                $('.main-title').text('Ver Slip de Cotización');
            }else if(id=='issuance'){
                $('.main-title').text('Ver Certificado de Emision');
            }else if(id=='print_all'){
                $('.main-title').text('Ver Imprimir Todo');
            }
            $.get(href, function(response){
                console.log(response);
                $('#prueba_modal .modal-body').html(response.payload);
                $('#prueba_modal').modal();
                //$("#cargaexterna").html(htmlexterno);
            });
            //alert(href);
            /*
             $.ajax({
             type: 'post',
             cache: false,
             headers: { 'X-XSRF-TOKEN' : $_token },
             url: 'the_url_to_controller_thru_route/' + some_parameters_if_needed,
             //contentType: "application/json; charset=utf-8",
             //dataType: 'json',
             data: {personid: 873}, //assuming that you send some data like id of a person to controller
             success: function(data) {
             }
             });
             */
        });
    });
</script>
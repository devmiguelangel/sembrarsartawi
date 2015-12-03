/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * funcion carga modal por ajax
 * @param {type} id_header
 * @param {type} tokken
 * @param {type} url
 * @param {post} post
 * @param {type} type
 * @returns {undefined}
 */
function cargaModal(id_header, tokken, url, post, type) {
    $.ajax({
        url: url,
        type: post,
        data: {
            type: type,
            id_header: id_header,
            _token: tokken
        },
        dataType: 'JSON',
        beforeSend: function() {
            $("#respuesta").html('Buscando cliente...');
        },
        error: function() {
            $("#respuesta").html('<div> Ha surgido un error. </div>');
        },
        success: function(respuesta) {
            console.log(respuesta.template_cert);
            if (respuesta) {
                $("#respuesta").html(respuesta.template_cert);
            } else {
                $("#respuesta").html('<div> No hay ningún cliente con ese id. </div>');
            }
        }
    });
}

/**
 * funcion imprime modal
 * @param {type} idDiv
 * @returns {undefined}
 */
function printSelec(idDiv) {
    var ficha = document.getElementById(idDiv);
    var ventimp = window.open(' ', 'popimpr');
    ventimp.document.write(ficha.innerHTML);
    ventimp.document.close();
    ventimp.print();
    ventimp.close();
}

	

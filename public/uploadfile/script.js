// JavaScript Document

$(document).ready(function() {
    var options = {
        target:   '#output',   // target element(s) to be updated with server response
        beforeSubmit:  beforeSubmit,  // pre-submit callback
        success:       afterSuccess,  // post-submit callback
        uploadProgress: OnProgress, //upload progress callback
        resetForm: true        // reset the form after successful submit
    };

    $('#MyUploadForm').submit(function() {
        $(this).ajaxSubmit(options);
        // always return false to prevent standard browser submit and page navigation
        return false;
    });


//function after succesful file upload (when server response)
    function afterSuccess()
    {
        $('#submit-btn').show(); //hide submit button
        $('#loading-img').hide(); //hide submit button
        $('#progressbox').delay( 2000 ).fadeOut(); //hide progress bar

    }

//function to check file size before uploading.
    function beforeSubmit(){
        //check whether browser fully supports all File API
        var data_admin = $('#admin').prop('value');
        var city = $('#id_retailer_city option:selected').prop('value');
        var id_retailer = $('#id_retailer option:selected').prop('value');

        if (window.File && window.FileReader && window.FileList && window.Blob)
        {

            if(data_admin=='user'){
                if(id_retailer==0){
                    $("#output_select_retailer").html("Seleccione el retailer");
                    return false
                }

                if(city==0){
                    $("#output_select").html("Seleccione un region/departamento");
                    return false
                }
            }

            if( !$('#FileInput').prop('value')) //check empty input filed
            {
                $("#output").html("Seleccione un archivo");
                return false
            }

            var fsize = $('#FileInput')[0].files[0].size; //get file size
            var ftype = $('#FileInput')[0].files[0].type; // get file type

            console.log(ftype);
            //alert(ftype);
            //allow file types
            switch(ftype)
            {
                case 'application/vnd.ms-excel':
                case 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet':
                    break;
                default:
                    $("#output").html("<b>"+ftype+"</b> Tipo de archivo no soportado!");
                    return false
            }

            //Allowed file size is less than 5 MB (1048576)
            if(fsize>5242880)
            {
                $("#output").html("<b>"+bytesToSize(fsize) +"</b> Too big file! <br />File is too big, it should be less than 5 MB.");
                return false
            }

            $('#submit-btn').hide(); //hide submit button
            $('#loading-img').show(); //hide submit button
            $("#output").html("");
            $("#output_select").html("");
        }
        else
        {
            //Output error to older unsupported browsers that doesn't support HTML5 File API
            $("#output").html("Please upgrade your browser, because your current browser lacks some new features we need!");
            return false;
        }
    }

//progress bar function
    function OnProgress(event, position, total, percentComplete)
    {
        //Progress bar
        $('#progressbox').show();
        $('#progressbar').width(percentComplete + '%') //update progressbar percent complete
        $('#statustxt').html(percentComplete + '%'); //update status text
        if(percentComplete>50)
        {
            $('#statustxt').css('color','#000'); //change status text to white after 50%
        }
    }

//function to format bites bit.ly/19yoIPO
    function bytesToSize(bytes) {
        var sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
        if (bytes == 0) return '0 Bytes';
        var i = parseInt(Math.floor(Math.log(bytes) / Math.log(1024)));
        return Math.round(bytes / Math.pow(1024, i), 2) + ' ' + sizes[i];
    }

});

function redirect(url, delay) {
	delay = delay * 1000;
	setTimeout(function(){
		location.href = url;
	}, delay);
}
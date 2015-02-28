
$(document).ready(function() {
    $("#sendFile").click(function(e) {
        $('#dvLoading').fadeOut(1000).css('display', 'block');
        e.preventDefault();
        var formObj = $("#formUploader");
        if (formObj.valid()) {
            var formURL = formObj.attr("action");
            $.ajax({
                url: formURL,
                type: 'POST',
                data: new FormData(document.getElementById("formUploader")),
                mimeType: "multipart/form-data",
                contentType: false,
                cache: false,
                processData: false,
                success: function(d) {
                    var data = JSON.parse(d);
                    console.log(data);
                    if (data.err === null) {
                        alert("Ocurrió un error al procesar el archivo ya que ha sido cargado anteriormente.");
                    } else if (data.err === -1) {
                        alert("Ocurrió un error al procesar el archivo.");
                    } else if (data.err === -4) {
                        alert("Lo sentimos su archivo no ha sido cargada debido a que no corresponde al mes actual.");
                    } else if (data.err > 0) {
                        alert(data.detalle);
                        
                        formObj.trigger("reset");
                    }
                    $('#dvLoading').css('display', 'none');
                },
                error: function() {
                    alert("Ocurrió un error al cargar el archivo XLSX");
                    $('#dvLoading').css('display', 'none');
                }
            });
        }
        
    });
});


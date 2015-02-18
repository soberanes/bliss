
$(document).ready(function() {
    $("#sendFactura").click(function(e) {
        $('#dvLoading').fadeOut(1000).css('display', 'block');
        e.preventDefault(); //Prevent Default action.
        var formObj = $("#facturaFormUploader");
        if (formObj.valid()) {
            var formURL = formObj.attr("action");
            $.ajax({
                url: formURL,
                type: 'POST',
                data: new FormData(document.getElementById("facturaFormUploader")),
                mimeType: "multipart/form-data",
                contentType: false,
                cache: false,
                processData: false,
                success: function(d) {
                    console.log(d);
                    var data = JSON.parse(d);
                    if (data.err === null) {
                        alert("Ocurrió un error al procesar el XML\nLa factura ya ha sido cargada anteriormente");
                    } else if (data.err === -1) {
                        alert("Ocurrió un error al procesar el XML\nLa factura no tiene SKUs");
                    } else if (data.err === -2) {
                        alert("Ocurrió un error al procesar el XML\nEl RFC de la factura cargada no corresponde al RFC Mayorista con el que se registró en la plataforma");
                    } else if (data.err === -3) {
                        alert("Ocurrió un error al procesar el XML\nLa factura es inválida");
                    } else if (data.err === -4) {
                        alert("Lo sentimos tu factura no ha sido cargada debido a que no corresponde al mes actual.");
                    } else if (data.err > 0) {
                        alert("Su factura se procesó correctamente");
                    }
                    $('#dvLoading').css('display', 'none');
                },
                error: function() {
                    alert("Ocurrió un error al cargar el XML");
                    $('#dvLoading').css('display', 'none');
                }
            });
        }
    });
});


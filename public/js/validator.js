/* validate complete registration */
var validaFormRefaccionaria = function() {
	var rules = {
	    rules: {
	        razon_social: {required: true},
	        nombre: {required: true},
	        nombre_distribuidor: {required: true},
	        nombre_vendedor: {required: true},
	        domicilio: {required: true},
	        estado: {required: true},
	        cp: numberValues(5, 6, true,[0,99999]),
	        celular: numberValues(10, 10, true,[1111111111,9999999999]),
	        telefono: numberValues(10, 10, true,[1111111111,9999999999]),
	        email: {required: true}
	    },
	    messages: {
	        celular:"Por favor proporciona un número celular válido",
	        telefono: "Por favor proporciona un número telefónico válido"
	    },
	    highlight: function(element) {
	        $(element).closest('.control-group').removeClass('success').addClass('error');
	    },
	    success: function(element) {
	        element.text('OK!').addClass('valid')
	                .closest('.control-group').removeClass('error').addClass('success');
	    }
	};
	$('#complete-ref').validate(rules);
};
var validaFormDistribuidor = function() {
	var rules = {
	    rules: {
	        razon_social: {required: true},
	        nombre: {required: true},
	        domicilio: {required: true},
	        estado: {required: true},
	        cp: numberValues(5, 6, true,[0,99999]),
	        celular: numberValues(10, 10, true,[1111111111,9999999999]),
	        telefono: numberValues(10, 10, true,[1111111111,9999999999]),
	        email: {required: true}
	    },
	    messages: {
	        celular:"Por favor proporciona un número celular válido",
	        telefono: "Por favor proporciona un número telefónico válido"
	    },
	    highlight: function(element) {
	        $(element).closest('.control-group').removeClass('success').addClass('error');
	    },
	    success: function(element) {
	        element.text('OK!').addClass('valid')
	                .closest('.control-group').removeClass('error').addClass('success');
	    }
	};
	$('#complete-dist').validate(rules);
};

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
var textValues = function(min, max, required) {
    return {minlength: min, maxlength: max, required: required};
};
var numberValues = function(min, max, required, range) {
    return {minlength: min, maxlength: max, required: required, number: true, range: range};
};
var mailValues = function(min, max, required) {
    return {minlength: min, maxlength: max, required: required, email: true};
};
var urlValues = function(min, max, required) {
    return {minlength: min, maxlength: max, required: required, url: true};
};
var dateValues = function(min, max, required) {
    return {minlength: min, maxlength: max, required: required, date: true};
};
//var validaRecovery = function() {
//    $(document).ready(function() {
//        var rules = {
//            rules: {
//                email: mailValues(5, 60, true)
//            },
//            highlight: function(element) {
//                $(element).closest('.control-group').removeClass('success').addClass('error');
//            },
//            success: function(element) {
//                element
//                        .text('OK!').addClass('valid')
//                        .closest('.control-group').removeClass('error').addClass('success');
//            }
//        };
//        $('#recovery').validate(rules);
//    });
//};
var validaFactura = function() {
    $(document).ready(function() {
        var rules = {
            rules: {
                name: textValues(5, 30, true),
                archivo: {required: true, extension: 'xml'}
            },
            highlight: function(element) {
                $(element).closest('.control-group').removeClass('success').addClass('error');
            },
            success: function(element) {
                element
                        .text('OK!').addClass('valid')
                        .closest('.control-group').removeClass('error').addClass('success');
            }
        };
        $('#facturaFormUploader').validate(rules);
    });
};
//var validaFile = function() {
//    $(document).ready(function() {
//        var rules = {
//            rules: {
//                archivo: {required: true, extension: 'xlsx'}
//            },
//            highlight: function(element) {
//                $(element).closest('.control-group').removeClass('success').addClass('error');
//            },
//            success: function(element) {
//                element
//                        .text('Da click nuevamente para confirmar').addClass('filevalid')
//                        .closest('.control-group').removeClass('error').addClass('filevalid');
//            }
//        };
//        $('#formUploader').validate(rules);
//    });
//};
var validaFormInfoUser = function() {
    $(document).ready(function() {
        var rules = {
            rules: {
                nombre: textValues(10, 60, true),
                email: mailValues(5, 60, true)
            },
            highlight: function(element) {
                $(element).closest('.control-group').removeClass('success').addClass('error');
            },
            success: function(element) {
                element
                        .text('OK!').addClass('valid')
                        .closest('.control-group').removeClass('error').addClass('success');
            }
        };
        $('#formBasInfo').validate(rules);
    });
};
var validaFormMayorista = function() {
    $(document).ready(function() {
        var rules = {
            rules: {
                mayoristaid: {required: true},
                sucursalid: {required: true},
                celular: numberValues(10, 10, true,[1111111111,9999999999]),
                generoid: {required: true},
                fechaNacimiento: dateValues(8, 10, true)
            },
            messages: {
                celular:"Por favor proporciona un número celular válido"
            },
            highlight: function(element) {
                $(element).closest('.control-group').removeClass('success').addClass('error');
            },
            success: function(element) {
                element.text('OK!').addClass('valid')
                        .closest('.control-group').removeClass('error').addClass('success');
            }
        };
        $('#formMayorista').validate(rules);
    });
};

$(document).ready(function() {
    validaFormMayorista();
    validaFormInfoUser();
    validaFormDistribuidor();
    validaFactura();
    validaFormRefaccionaria();
//    validaFile();
//    validaRecovery();
//    validaFormInfoUser();
//    validaFormMayorista();
//    validaFormInfoAdUser();

});
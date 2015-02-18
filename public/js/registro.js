/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


$(document).ready(function() {
    $("#fechaNacimiento").datepicker({
        dateFormat: 'dd/mm/yy',
        changeMonth: true,
        changeYear: true,
        yearRange: '1920:1998',
        defaultDate: '01/01/1980'
    });
    $("#fechanacimiento_").datepicker({
        dateFormat: 'dd/mm/yy',
        changeMonth: true,
        changeYear: true,
        yearRange: '1920:1998',
        defaultDate: '01/01/1980'
    });

    $.fn.serializeObject = function() {
        var o = {};
        var a = this.serializeArray();
        $.each(a, function() {
            if (o[this.name] !== undefined) {
                if (!o[this.name].push) {
                    o[this.name] = [o[this.name]];
                }
                o[this.name].push(this.value || '');
            } else {
                o[this.name] = this.value || '';
            }
        });
        return o;
    };
    $.fn.sendForm = function() {
        var url = this.attr('action');
        var data = this.toJSON();
        return sendPost(url, data);
    };
    $.fn.toJSON = function() {
        return JSON.parse(JSON.stringify(this.serializeObject()));
    };
    var sendPost = function(url, data) {
        return $.ajax({
            type: "POST",
            url: url,
            data: data,
            contentType: "application/json",
            dataType: "json"
        });
    };
    $("#cp").focusout(function() {
        var value = this.value;
        if (value !== "") {
            var data = '{"cp":"' + value + '"}';
            sendPost('registro/getinfo', data).success(function(data) {
                $("#municipio").val(data.municipio);
                $("#estado").val(data.estado);
                $("#cpId").find('option').remove().end().append('<option value="">Colonia</option>');
                $.each(data.colonias, function(i, colonia) {
                    $("#cpId").append('<option value="' + i + '">' + colonia + '</option>');
                });
            });
        }
    });
    $("#mayoristaid").change(function() {
        var value = this.value;
        if (value !== "") {
            getSucursal(value, "sucursalid");
        }
    });
    $("#mayoristaid_").change(function() {
        var value = this.value;
        if (value !== "") {
            getSucursal(value, "sucursalid_");
        }
    });
    var getSucursal = function(value, elementId) {
        var data = '{"mayoristaid":"' + value + '"}';
        sendPost('registro/getsucursal', data).success(function(data) {
            $("#" + elementId).find('option').remove().end().append('<option value="">Selecciona tu Sucursal</option>');
            $.each(data, function(i, sucursal) {
                $("#" + elementId).append('<option value="' + i + '">' + sucursal + '</option>');
            });
        });
    };
    $("#SendMayorista").click(function(e) {
        e.preventDefault();
        sendForm('formBasInfo', 'formMayorista');
    });
    $("#SendDist").click(function(e) {
        e.preventDefault();
        sendForm('formBasInfo', 'formDistribuidor');
    });
    var sendForm = function(formName1, formName2) {
        var form1 = $('#' + formName1);
        var form2 = $('#' + formName2);
        var a = form1.valid();
        a &= form2.valid();
        if (a) {
            $('#dvLoading').fadeOut(1000).css('display', 'block');
            var json1 = form1.toJSON();
            var json2 = form2.toJSON();
            var data = JSON.stringify($.extend(false, {}, json1, json2));
            console.log(data);
            sendPost('registro/save', data).success(function(data) {
                if (data.procesado) {
                    alert("Se ha guardado correctamente la información\n\
Debes estar recibiendo un email confirmando tu registro(Puede que este en tu bandeja de correos No Deseados)");
                    window.location.href = '/';
                } else {
                    alert("Error\nOcurrió un problema al guardar la información\n\nEl Email Porporcionado ya ha sido registrado en la plataforma");
                }
                $('#dvLoading').css('display', 'none');
            });
//                hideLoading();
        } else {
            alert("Existen errores en el formulario,\n\nFavor de corregirlos");
        }
    };
    $("#fvnmay").click(function() {
        $("#divfvnmay").css('display', 'block');
        $("#divdist").css('display', 'none');
    });
    $("#fvndst").click(function() {
        $("#divdist").css('display', 'block');
        $("#divfvnmay").css('display', 'none');
    });
});
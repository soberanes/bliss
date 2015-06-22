$(function() {
	$( ".navbar-toggle" ).click(function() {
		$( "#second-nav-content" ).toggle();
	});

	$('.link_tooltip').tooltip();

	/* AJAX process */

	$("#search-product").submit(function(event){
        event.preventDefault();

        var search_data = $(this).serialize(), //search-filter
        	url_action  = $(this).attr('action'); 

        $.ajax({
			type: "POST",
			url: url_action,
			data: search_data,
			success: function(data){
                $('#to-add-products-table tbody').html(data);
                console.log('OK');
			},
		});

        return false;

    });
    
    $("#support-form").submit(function(event){
        event.preventDefault();

        var search_data = $(this).serialize(), //search-filter
        	url_action  = $(this).attr('action'); 

        $.ajax({
			type: "POST",
			url: url_action,
			data: search_data,
			success: function(data){
                if(data == 1){
                	alert('Su mensaje ha sido enviado. Le responderémos a la brevedad posible. Gracias.');
                }else{
                	alert('Ha ocurrido un problema. Por favor inténtelo de nuevo.');
                }
                $('#soporte').modal('hide')
			},
		});

        return false;

    });
    
    //$('#preview-button').attr('disabled','true');
});


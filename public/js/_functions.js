jQuery(document).ready(function($) {
	
	$('#banner-slide').bjqs({
        animtype      : 'slide',
        height      : 412,
        width       : 940,
        responsive    : false,
        nexttext : 'Next',
        prevtext : 'Prev',
        randomstart   : false
    });

    $( "#birthdate" ).datepicker({
        dateFormat: 'dd/mm/yy',
        changeMonth: true,
        changeYear: true,
        yearRange: "-100:+0"
    });

    $( document ).tooltip();

	var $elems = $('.animateblock');
	var winheight = $(window).height();
	var fullheight = $(document).height();
	  
	$(window).scroll(function(){
	  animate_elems();
	});
	  
	function animate_elems() {
	  wintop = $(window).scrollTop(); // calculate distance from top of window
	
	  // loop through each item to check when it animates
	  $elems.each(function(){
		  $elm = $(this);
		     
		  if($elm.hasClass('animated')) { return true; } // if already animated skip to the next item
		    
		  topcoords = $elm.offset().top; // element's distance from top of page in pixels
		      
		  if(wintop > (topcoords - (winheight*.75))) {
		     // animate when top of the window is 3/4 above the element
	         $elm.addClass('animated');
		  }
	  });
	} // end animate_elems()

	//AJAX process to send notification to user about invalid information loaded.
	$('.status_1').on('click', function(){

		var request_url = $('base').attr('href') + '/notify-user';
		var user_id 	= $(this).attr('data-info');
		var user_load 	= $(this).attr('data-load');
		var element = $(this);
		element.addClass('parpadea');

		$.ajax({
		    type:"POST",
		    data: 'user_id='+user_id+'&user_load='+user_load,
		    url:  request_url,
		    success: function(data){
		        //$("#resultado").html(response);
		        element.removeClass('parpadea');
		        element.addClass('status_3');
		        $('#process_'+user_load).prop( "disabled", true );
		    }
	    });
	});

	$('.validate_btn').on('click', function(){

		var request_url = $('base').attr('href') + '/validate';
		var data_load 	= $(this).attr('data-load');
		var data_user   = $(this).attr('data-user');
	
		// $('.validate_btn').attr('disabled','true');
		$(this).addClass('parpadea');
		
		$.ajax({
		    type:"POST",
		    data: 'data_load='+data_load,
		    url:  request_url,
		    success: function(data){
		    	console.log(data);
		        $('.validate_btn').removeClass('parpadea');
		        if(data.response){
		        	// $('.validate_btn').attr('disabled','true');
		        	$('#process'+data_user).text(data.process_d);
		        	$('#val'+data_user).removeClass('status_1').addClass('status_3');
		        	alert('El proceso de asignación de puntos a esta sucursal ha terminado.')
		        }else{
		        	// $('.validate_btn').attr('disabled','false');
		        }		        
		    }
	    });
	});

	$('.btn-cuota').on('click', function(e){
		e.preventDefault();

		var request_url = $('base').attr('href') + '/cuotas/save-cuota';
		var id 			= $(this).attr('data-btn');
		var reference 	= $(this).attr('data-reference');
		var cuota_field = $('#cell_cuota_' + id).val();

		$(this).text('Guardando...');

		$.ajax({
			type:"POST",
			data:"cuota_id="+id+"&cuota_data="+cuota_field+"&ref="+reference,
			url: request_url,
			success: function(data){
				$('.notification').stop().text(data.detalle).fadeIn('slow').delay( 900 ).fadeOut('slow');
				$('.btn-cuota').text('Guardar');
			}
		});
	});

	


	/* Aplicaciones de tenolite */
	$('.upload').on("change", function(){ 
		var filename = $(this).next();
		var filestr  = $(this).val();
		filename.val(filestr.slice(-17));
		// $(this).next(".filename").val($(this).val());
	});

	$('#txt-perfil').change(function(){
		var option = $('#txt-perfil option:selected').val();
		
		if(option == 2){
			$('#parent_content').show();
		}else{
			$('#parent_content').hide();
		}

		if(option == 3){
			$('#sucursal_content').show();
		}else{
			$('#sucursal_content').hide();
		}




	});

	// $('.apps-upload').submit(function(){
	// 	var formObj = $(".apps-upload");
	// 	var formURL = formObj.attr("action");

	// 	console.log($(this).serialize());

 //        $.ajax({
 //            url: formURL,
 //            type: 'POST',
 //            data: new FormData(formObj), //$(this).serialize(), //new FormData(document.getElementById("formUploader")),
 //            mimeType: "multipart/form-data",
 //            contentType: false,
 //            cache: false,
 //            processData: false,
 //            success: function(d) {
 //                var data = JSON.parse(d);
 //                console.log(data);
 //                if (data.err === null) {
 //                    alert("Ocurrió un error al procesar el archivo ya que ha sido cargado anteriormente.");
 //                } else if (data.err === -1) {
 //                    alert("Ocurrió un error al procesar el archivo.");
 //                } else if (data.err === -4) {
 //                    alert("Lo sentimos su archivo no ha sido cargada debido a que no corresponde al mes actual.");
 //                } else if (data.err > 0) {
 //                    alert(data.detalle);
                    
 //                    formObj.trigger("reset");
 //                }
 //                $('#dvLoading').css('display', 'none');
 //            },
 //            error: function() {
 //                alert("Ocurrió un error al cargar el archivo.");
 //                $('#dvLoading').css('display', 'none');
 //            }
 //        });

	// 	return false;
	// });

});
jQuery(document).ready(function($) {
	
	$('#banner-slide').bjqs({
        animtype      : 'slide',
        height      : 412,
        width       : 940,
        responsive    : false,
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
		        console.log(element);
		        // console.log(data);
		    }
	    });
	});

	$('.validate_btn').on('click', function(){

		var request_url = $('base').attr('href') + '/validate';
		var archivo_id 	= $(this).attr('data-file');
	
		$('.validate_btn').attr('disables','true');
		$(this).addClass('parpadea');
		
		$.ajax({
		    type:"POST",
		    data: 'archivo_id='+archivo_id,
		    url:  request_url,
		    success: function(data){
		        //$("#resultado").html(response);
		        $('.validate_btn').attr('disables','false');
		        $('.validate_btn').removeClass('parpadea');
		        console.log('stop');
		        console.log(data);
		    }
	    });
	});



});
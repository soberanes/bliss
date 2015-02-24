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

});

$(function(){
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

});
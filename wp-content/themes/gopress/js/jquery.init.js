jQuery(function($){
	$(document).ready(function(){
		//dropdowns
		$("ul.sf-menu").superfish({ 
			autoArrows: true,
			animation:  {opacity:'show',height:'show'}
		});
		//homepage slides
		$('#home-slides').slides({
			effect: 'fade',
			crossfade: true,
			fadeSpeed: 800,
			slideSpeed: 700,
			play: 5000,
			pause: 10,
			autoHeight: true,
			preload: true,
			hoverPause: true,
			generateNextPrev: true,
			generatePagination: true
		});
		//comment check
		$('#commentform').submit(function(e) {
			var $urlField = $(this).children('#url');
			if($urlField.val() == 'Website') {
				$urlField.val('')
			}
		});

	}); // END doc ready
}); // END function
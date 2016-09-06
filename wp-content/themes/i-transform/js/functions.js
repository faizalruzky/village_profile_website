/**
 * Functionality specific to i-transform.
 *
 * Provides helper functions to enhance the theme experience.
 */

( function( $ ) {
	var body    = $( 'body' ),
	    _window = $( window );
	
	/**
	 * Enables menu toggle for small screens.
	 */
	( function() {
		var nav = $( '#site-navigation' ), button, menu;
		if ( ! nav )
			return;

		button = nav.find( '.menu-toggle' );
		if ( ! button )
			return;

		// Hide button if menu is missing or empty.
		menu = nav.find( '.nav-container' );
		if ( ! menu || ! menu.children().length ) {
			button.hide();
			return;
		}

		$( '.menu-toggle' ).on( 'click.itransform', function() {
			//nav.toggleClass( 'toggled-on' );
		} );
	} )();

	/**
	 * Makes "skip to content" link work correctly in IE9 and Chrome for better
	 * accessibility.
	 *
	 * @link http://www.nczonline.net/blog/2013/01/15/fixing-skip-to-content-links/
	 */
	_window.on( 'hashchange.itransform', function() {
		var element = document.getElementById( location.hash.substring( 1 ) );

		if ( element ) {
			if ( ! /^(?:a|select|input|button|textarea)$/i.test( element.tagName ) )
				element.tabIndex = -1;

			element.focus();
		}
	} );

		
} )( jQuery );

/* scripts to run on document ready */
jQuery(document).ready(function($) {
	
	/* customizing the drop down menu */
	jQuery('div.nav-container > ul > li > a').append( '<span class="colorbar"></span>' );
    jQuery('div.nav-container ul > li').hover(function() {
        jQuery(this).children('ul.children,ul.sub-menu').stop(true, true).slideDown("fast");
    }, function(){
        jQuery(this).children('ul.children,ul.sub-menu').slideUp("fast");
    });
	
	jQuery('.search-form').append( '<span class="searchico genericon genericon-search"></span>' );
	
	
	/* initiating the slider 
	$('#da-slider').cslider({
		autoplay	: true,
		bgincrement	: 0,
		interval    : 10000
	});
	*/
	
	/* adding class for no featured image posts */
	$( "div.entry-nothumb" ).parent(".meta-img").addClass("no-image-meta");
	
	/* Go to top button */
	jQuery('body').append('<a href="#" class="go-top animated"><span class="genericon genericon-collapse"></span></a>');
                        // Show or hide the sticky footer button
    jQuery(window).scroll(function() {
        if (jQuery(this).scrollTop() > 200) {
        	jQuery('.go-top').fadeIn(200).addClass( 'bounce' );
        } else {
            jQuery('.go-top').fadeOut("slow");
        }
    });


    // Animate the scroll to top
    jQuery('.go-top').click(function(event) {
        event.preventDefault();
        jQuery('html, body').animate({scrollTop: 0}, 1000);
    });	
	
	
	/* Side responsive menu	 */
	$('.menu-toggle').sidr({
      	name: 'sidr-left',
      	side: 'left',
		source: '.nav-container',
			onOpen: function() {
				$('.menu-toggle').animate({
					marginLeft: "260px"
				}, 200);
			},
			onClose: function() {
				$('.menu-toggle').animate({
					marginLeft: "0px"
				}, 200);
			}
    });
	
	$(window).resize(function () {
        if ($(window).width() > 1070) {
            $.sidr('close', 'sidr-left');
        }
	  	equalheight('#ft-post article');
    });	
	
	/*equal height for featured post for two column view */
	
	equalheight = function(container){
	
		var currentTallest = 0,
			 currentRowStart = 0,
			 rowDivs = new Array(),
			 $el,
			 topPosition = 0;
		$(container).each(function() {
		
		   $el = $(this);
		   $($el).height('auto')
		   topPostion = $el.position().top;
		
		   	if (currentRowStart != topPostion) {
				for (currentDiv = 0 ; currentDiv < rowDivs.length ; currentDiv++) {
			   		rowDivs[currentDiv].height(currentTallest);
			 	}
			 	rowDivs.length = 0; // empty the array
			 	currentRowStart = topPostion;
			 	currentTallest = $el.height();
			 	rowDivs.push($el);
		   	} else {
			 	rowDivs.push($el);
			 	currentTallest = (currentTallest < $el.height()) ? ($el.height()) : (currentTallest);
		  	}
		   	for (currentDiv = 0 ; currentDiv < rowDivs.length ; currentDiv++) {
			 	rowDivs[currentDiv].height(currentTallest);
		   	}
		});
	}

  	equalheight('.main article');
	


	/*
	$(window).scroll(function(){
		var newvalue = parseInt($(this).scrollTop()*0.25)-64;
    	$('.ibanner').css('background-position', '0px '+newvalue+'px');
	});
	*/
	
	

	// footer area masonry
	var container_1 = $('.site-footer .widget-area');
	//var msnry_1 = new Masonry( container_1, {
	  //columnWidth: 60
	//});
	
	container_1.imagesLoaded( function(){
	  container_1.masonry({});
	});	
	
	// Two column Blog layout masonry
	var container_2 = $('.twocol-blog .blog-columns');
	//var msnry_2 = new Masonry( container_2, {
	  //columnWidth: 60
	//});
	container_2.imagesLoaded( function(){
	  container_2.masonry({});
	})		
	
		
	
});

/* scripts to run as loads */

(function($) {
	
	/* acrolling header */
	var nav_container = $(".headerwrap");
	var nav = $(".site-header");

	var top_spacing = 30;
	var waypoint_offset = 60;
	
	if ( $(".admin-bar").length>0 )
	{
		if($( window ).width()<766)
		{
			var top_spacing = 0;
		} else
		{
			var top_spacing = 30;
		}
	} else
	{
		var top_spacing = 0;
	}
	nav_container.waypoint({
		handler: function(direction) {
			
			if (direction == 'down') {
				nav_container.css({ 'height':nav.outerHeight() });		
				nav.stop().addClass("fixeddiv").css("top",-nav.outerHeight()).animate({"top":top_spacing});
			} else {
			
				nav_container.css({ 'height':'auto' });
				nav.stop().removeClass("fixeddiv").css("top",nav.outerHeight()).animate({"top":""});
			}
			
		},
		offset: function() {
			return -nav.outerHeight()-waypoint_offset;
		}
	});

	/* no utility bar class addition */
	if ( $('.utilitybar').length == 0 )
	{
		console.log("no utility bar");
		$('.headerwrap').addClass('noutility');
	}
	
	/* featured post on scroll animation */
	$('div#featured .post').css("opacity","0.0");
	
	$('div#featured').waypoint(function() {
		$( "div#featured .post" ).each(function(index) {
			var _this = $(this);
			setTimeout( function () {
				$('div#featured .post').show();
				_this.addClass( 'animated fadeInUp' );
				_this.css("opacity","1.0");
   			}, (index+1) * 200);
		});
	},
	{
		offset: '100%',
		triggerOnce: true
	});
	
	
	$('div#primary div.entry-thumbnail').waypoint(function() {
		$(this).addClass( 'animated fadeInLeft' );
	},
	{
		offset: '100%',
		triggerOnce: true
	});
	
	$('div#primary div.post-mainpart').waypoint(function() {
		$(this).addClass( 'animated fadeInUp' );
	},
	{
		offset: '100%',
		triggerOnce: true
	});
		
		
		
		
	/*
	i-trans multi layer slider
	*/
	var slidetimer = null;
	var slidemove = 1;
	function startSetInterval() {
		if(slidemove==1){
		slidetimer = setInterval(function () {
			moveRight();
    	}, sliderscpeed);
		}
	}
	if(slidemove==1){
		startSetInterval();
	}
	
	// hover behaviour
	$('.ibanner #da-slider, .sldprev, .sldnext').hover(function() {
	  	slidemove = 0;
		clearInterval(slidetimer);
		//console.log("stop timer");
	},function() {
	  	slidemove = 1;
		startSetInterval();
		//console.log("start timer");
	});
	
 
  	var theslider = $('#da-slider')
	var slideCount = $('#da-slider .da-slide').length;
	var clickstat = 0;
	

	var $slidernav	= $( '<nav class="da-dots"/>' );
		
		for( var i = 0; i < slideCount; ++i ) {
				$slidernav.append( '<span/>' );			
		}
		$slidernav.appendTo( theslider );

	
	var currentslide = 1;	
	
    function moveLeft() {
		if (currentslide > slideCount)
		{
			currentslide = 1;
		}
		
		$('.da-slide-current').addClass('da-slide-toleft').removeClass('da-slide-current');
		$('.da-slide:nth-child('+currentslide+')').removeClass('da-slide-toleft da-slide-toright da-slide-fromleft da-slide-fromright').addClass('da-slide-current da-slide-fromright');
		$('.da-dots-current').removeClass('da-dots-current');
		$('.da-dots span:nth-child('+currentslide+')').addClass('da-dots-current');
		
		currentslide = currentslide+1;		
    };

    function moveRight() {
		if (currentslide > slideCount)
		{
			currentslide = 1;
		}
	
		$('.da-slide-current').addClass('da-slide-toright').removeClass('da-slide-current');
		$('.da-slide:nth-child('+currentslide+')').removeClass('da-slide-toleft da-slide-toright da-slide-fromleft da-slide-fromright').addClass('da-slide-current da-slide-fromleft');
		$('.da-dots-current').removeClass('da-dots-current');
		$('.da-dots span:nth-child('+currentslide+')').addClass('da-dots-current');
		
		currentslide = currentslide+1;
    };
	
	$('.da-dots > span').click(function() {
		if (clickstat == 0)
		{
			var index = $(this).parent().find('> ' + this.tagName).index(this);
			currentslide = index+1;
			moveRight();
			clickstat = 1;			
			setTimeout(function () {
				clickstat = 0;
			}, 1000);			
		}
	});	

    $('.sldprev').click(function ( event ) {
		if (clickstat == 0)
		{		
			moveLeft();
			
			clickstat = 1;			
			setTimeout(function () {
				clickstat = 0;
			}, 1000);			
		}
		event.preventDefault();
    });

    $('.sldnext').click(function ( event ) {
		if (clickstat == 0)
		{		
			moveRight();
			
			clickstat = 1;			
			setTimeout(function () {
				clickstat = 0;
			}, 1000);
		}
		event.preventDefault();
    });
	
	
	/* creating the slider navigation tabs */
	var totalslide = 0;
	if ($( ".da-slider > .da-slide" ).length > 0)
	{
		$( ".da-slider > .da-slide" ).each(function() {
			totalslide = totalslide+1;
		});
		$(".da-dots > span").css("width", 100/totalslide+"%");
		$(".da-dots > span").append('<span></span>');
	}

	setTimeout(moveRight(),1000);	
	
		
})(jQuery);
/**/

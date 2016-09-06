/*
*      Robo Gallery     
*      Version: 1.0
*      By Robosoft
*
*      Contact: http://robosoft.co
*      Created: 2015
*      Licensed under the GPLv2 license - http://opensource.org/licenses/gpl-2.0.php
*
*      Copyright (c) 2014-2015, Robosoft. All rights reserved.
*      Available only in http://robosoft.co/
*/

(function($) {
	jQuery('.robo_gallery').each( function(){
		var objectOptions = window[ jQuery(this).data('options') ];
		var realOptions = jQuery.extend({},objectOptions);
		var gallery = jQuery(this).collagePlus( realOptions ); 
		if( roboGalleryDelay != undefined && roboGalleryDelay > 0 ){
			setTimeout(function () {
				gallery.eveMB('resize');
				//console.log("roboGallery - resize"); 
			}, roboGalleryDelay);
		}
	});
})(jQuery);
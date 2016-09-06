<?php
/*
*      Robo Gallery     
*      Version: 1.5
*      By Robosoft
*
*      Contact: http://robosoft.co
*      Created: 2015
*      Licensed under the GPLv2 license - http://opensource.org/licenses/gpl-2.0.php
*
*      Copyright (c) 2014-2015, Robosoft. All rights reserved.
*      Available only in http://robosoft.co/
*/



if( !class_exists('RoboGalleryConfig') ){
	class RoboGalleryConfig {

    	public static function guides() {
    		
    		$guides =  array(
				array(
					'link'=> 	'https://www.youtube.com/watch?v=DdCpRuLFxzk',
					'text'=> 	'How to make custom grid layout?',
					'class'=> 	'violet'
				),
				array(
					'link'=> 	'https://www.youtube.com/watch?v=m9XIeqMnhYI',
					'text'=> 	'Install and configuration guide',
					'class'=> 	'green'
				),
				array(
					'link'=> 	'https://www.youtube.com/watch?v=mZ_yOXkxRsk',
					'text'=> 	'How to setup Polaroid style?',
					'class'=> 	'violet'
				),
				array(
					'link'=> 	'https://www.youtube.com/watch?v=svr_4Fuq9RM',
					'text'=> 	'How to manage categories?',
					'class'=> 	'green'
				),
				array(
					'link'=> 	'https://www.youtube.com/watch?v=RrWn8tMuKsw',
					'text'=> 	'How to manage gallery post?',
					'class'=> 	'violet'
				),
				array(
					'link'=> 	'https://www.youtube.com/watch?v=lxDR6E8erBA',
					'text'=> 	'How to create shortcode?',
					'class'=> 	'green'
				),
				array(
					'link'=> 	'https://www.youtube.com/watch?v=fI3uYOlUbo4',
					'text'=> 	'How to upload gallery images?',
					'class'=> 	'violet'
				),	
			);

			return $guides[ array_rand( $guides ) ];
    	}
	}
}
<?php
/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 * By default it uses the theme name, in lowercase and without spaces, but this can be changed if needed.
 * If the identifier changes, it'll appear as if the options have been reset.
 *
 */

function optionsframework_option_name() {

	// This gets the theme name from the stylesheet (lowercase and without spaces)
	$themename = get_option( 'stylesheet' );
	$themename = preg_replace("/\W/", "_", strtolower($themename) );

	$optionsframework_settings = get_option('optionsframework');
	$optionsframework_settings['id'] = $themename;
	update_option('optionsframework', $optionsframework_settings);

	// echo $themename;
}

/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the 'id' fields, make sure to use all lowercase and no spaces.
 *
 */

function optionsframework_options() {

	// Test data
	$test_array = array(
		'one' => __('One', 'itransform'),
		'two' => __('Two', 'itransform'),
		'three' => __('Three', 'itransform'),
		'four' => __('Four', 'itransform'),
		'five' => __('Five', 'itransform')
	);

	// Multicheck Array
	$multicheck_array = array(
		'one' => __('French Toast', 'itransform'),
		'two' => __('Pancake', 'itransform'),
		'three' => __('Omelette', 'itransform'),
		'four' => __('Crepe', 'itransform'),
		'five' => __('Waffle', 'itransform')
	);

	// Multicheck Defaults
	$multicheck_defaults = array(
		'one' => '1',
		'five' => '1'
	);

	// Background Defaults
	$background_defaults = array(
		'color' => '',
		'image' => '',
		'repeat' => 'repeat',
		'position' => 'top center',
		'attachment'=>'scroll' );

	// Typography Defaults
	$typography_defaults = array(
		'size' => '15px',
		'face' => 'georgia',
		'style' => 'bold',
		'color' => '#bada55' );

	// Typography Options
	$typography_options = array(
		'sizes' => array( '6','12','14','16','20' ),
		'faces' => array( 'Helvetica Neue' => 'Helvetica Neue','Arial' => 'Arial' ),
		'styles' => array( 'normal' => 'Normal','bold' => 'Bold' ),
		'color' => false
	);

	// Pull all the categories into an array
	$options_categories = array();
	$options_categories_obj = get_categories();
	foreach ($options_categories_obj as $category) {
		$options_categories[$category->cat_ID] = $category->cat_name;
	}

	// Pull all tags into an array
	$options_tags = array();
	$options_tags_obj = get_tags();
	foreach ( $options_tags_obj as $tag ) {
		$options_tags[$tag->term_id] = $tag->name;
	}

	// Pull all the pages into an array
	$options_pages = array();
	$options_pages_obj = get_pages('sort_column=post_parent,menu_order');
	$options_pages[''] = 'Select a page:';
	foreach ($options_pages_obj as $page) {
		$options_pages[$page->ID] = $page->post_title;
	}

	// If using image radio buttons, define a directory path
	$imagepath =  get_template_directory_uri() . '/images/';

	$options = array();

	$options[] = array(
		'name' => __('Basic Settings', 'itransform'),
		'type' => 'heading');

	$options[] = array(
		'name' => __('Phone Number', 'itransform'),
		'desc' => __('Phone number that appears on top bar.', 'itransform'),
		'id' => 'top_bar_phone',
		'std' => '',
		'class' => 'mini',
		'type' => 'text');
		

	$options[] = array(
		'name' => __('Email Address', 'itransform'),
		'desc' => __('Email Id that appears on top bar.', 'itransform'),
		'id' => 'top_bar_email',
		'std' => '',
		'class' => 'mini',
		'type' => 'text');		
		
	$options[] = array( 
		"name" => "Site header logo",
		"desc" => "Width 280px, height 72px max. Upload logo for header",
		"id" => "itrans_logo_image",
		"type" => "upload");
		
	$options[] = array( 
		"name" => "Site title/slogan (optional)",
		"desc" => "if you are using a logo and want your site title or slogan to appear on the header banner",
		"id" => "itrans_slogan",
		'std' => '',
		"type" => "text");

	$options[] = array(
		'name' => __('Layout Options', 'itransform'),
		'type' => 'heading');
		
				
	$options[] = array(
		'name' => "Color Scheme",
		'desc' => "Choose a color for layout.",
		'id' => "itrans_color_scheme",
		'std' => "blue",
		'type' => "images",
		'options' => array(
			'blue' => $imagepath . 'blue.png',		
			'red' => $imagepath . 'red.png',
			'green' => $imagepath . 'green.png',
			'yellow' => $imagepath . 'yellow.png',			
			'purple' => $imagepath . 'purple.png')
	);
	
	$options[] = array(
		'name' => "Blog Posts Layout",
		'desc' => "Choose blog posts layout (one column/two column)",
		'id' => "itrans_blog_layout",
		'std' => "onecol",
		'type' => "images",
		'options' => array(
			'onecol' => $imagepath . 'onecol.png',		
			'twocol' => $imagepath . 'twocol.png')
	);	
		
	$options[] = array(
		'name' => __('Boxed Type', 'itransform'),
		'desc' => __('Boxed Type layout at 1200px', 'itransform'),
		'id' => 'boxed_type',
		'std' => '',
		'type' => 'checkbox');	
		
	$options[] = array(
		'name' => "Background Image",
		'desc' => "Choose a background image for boxed type layout",
		'id' => "itrans_background",
		'std' => "1",
		'type' => "images",
		'options' => array(
			'1' => $imagepath . 'patt1.png',		
			'2' => $imagepath . 'patt2.png',
			'3' => $imagepath . 'patt3.png',
			'4' => $imagepath . 'patt4.png',			
			'5' => $imagepath . 'patt5.png'
			//'6' => $imagepath . 'patt6.png'
		)
	);
	
	$options[] = array( 
		"name" => "Custom Background Image",
		"desc" => "Upload or select a background image from media library",
		"id" => "itrans_bg_image",
		"type" => "upload");
		
	$options[] = array(
		'name' => "Background image size/repeat",
		'desc' => "Select cover to have a fullsize background image or Choose repeat to have the background in pattern",
		'id' => "itrans_bg_layout",
		'std' => "repeat",
		'type' => "select",
		'options' => array(
			'repeat' => 'Repeat',		
			'cover' => 'Cover')
	);			

	$options[] = array(
		'name' => __('Fixed background image attachment', 'itransform'),
		'desc' => __('Check if you want the background image to be fixed', 'itransform'),
		'id' => 'itrans_fixed_bg',
		'std' => '',
		'type' => 'checkbox');				
	
	$options[] = array(
		'name' => __('Additional style', 'itransform'),
		'desc' => __('add extra style(CSS) codes here', 'itransform'),
		'id' => 'itrans_extra_style',
		'std' => '',
		'type' => 'textarea');	
		
		
				
	$options[] = array(
		'name' => __('Social Links ', 'itransform'),
		'type' => 'heading');
		
	$options[] = array(
		'name' => __('Facebook', 'itransform'),
		'desc' => __('', 'itransform'),
		'id' => 'itrans_social_facebook',
		'std' => '',
		'type' => 'text');
		
	$options[] = array(
		'name' => __('Twitter', 'itransform'),
		'desc' => __('', 'itransform'),
		'id' => 'itrans_social_twitter',
		'std' => '',
		'type' => 'text');
		
	$options[] = array(
		'name' => __('Pinterest', 'itransform'),
		'desc' => __('', 'itransform'),
		'id' => 'itrans_social_pinterest',
		'std' => '',
		'type' => 'text');	
		
	$options[] = array(
		'name' => __('Flickr', 'itransform'),
		'desc' => __('', 'itransform'),
		'id' => 'itrans_social_flickr',
		'std' => '',
		'type' => 'text');

	$options[] = array(
		'name' => __('RSS', 'itransform'),
		'desc' => __('', 'itransform'),
		'id' => 'itrans_social_feed',
		'std' => '',
		'type' => 'text');

	$options[] = array(
		'name' => __('Instagram', 'itransform'),
		'desc' => __('', 'itransform'),
		'id' => 'itrans_social_instagram',
		'std' => '',
		'type' => 'text');
		
	$options[] = array(
		'name' => __('Google plus', 'itransform'),
		'desc' => __('', 'itransform'),
		'id' => 'itrans_social_googleplus',
		'std' => '',
		'type' => 'text');
		
	$options[] = array(
		'name' => __('YouTube', 'itransform'),
		'desc' => __('', 'itransform'),
		'id' => 'itrans_social_youtube',
		'std' => '',
		'type' => 'text');		
				
		
	/* Sliders */
	$options[] = array(
		'name' => __('Slider', 'itransform'),
		'type' => 'heading');
		
	$options[] = array(
		'name' => __('Slide Duration', 'itransform'),
		'desc' => __('slide visibility in milisecond ', 'itransform'),
		'id' => 'sliderspeed',
		'std' => '6000',
		'class' => 'mini',
		'type' => 'text');		

	$options[] = array(
		'name' => __('Slide1 Title', 'itransform'),
		'desc' => __('', 'itransform'),
		'id' => 'itrans_slide1_title',
		'std' => '',
		'type' => 'text');

	$options[] = array(
		'name' => __('Slide1 Description', 'itransform'),
		'desc' => __('', 'itransform'),
		'id' => 'itrans_slide1_desc',
		'std' => '',
		'type' => 'textarea');

	$options[] = array(
		'name' => __('Slide1 Link text', 'itransform'),
		'desc' => __('', 'itransform'),
		'id' => 'itrans_slide1_linktext',
		'std' => '',
		'type' => 'text');
		
	$options[] = array(
		'name' => __('Slide1 Link URL', 'itransform'),
		'desc' => __('', 'itransform'),
		'id' => 'itrans_slide1_linkurl',
		'std' => '',
		'type' => 'text');		

	$options[] = array(
		'name' => __('Slide1 Image', 'itransform'),
		'desc' => __('Ideal image size width: 564px and height: 280px', 'itransform'),
		'id' => 'itrans_slide1_image',
		'std' => '',
		'type' => 'upload');


	$options[] = array(
		'name' => __('Slide2 Title', 'itransform'),
		'desc' => __('', 'itransform'),
		'id' => 'itrans_slide2_title',
		'std' => '',
		'type' => 'text');

	$options[] = array(
		'name' => __('Slide2 Description', 'itransform'),
		'desc' => __('', 'itransform'),
		'id' => 'itrans_slide2_desc',
		'std' => '',
		'type' => 'textarea');

	$options[] = array(
		'name' => __('Slide2 Link text', 'itransform'),
		'desc' => __('', 'itransform'),
		'id' => 'itrans_slide2_linktext',
		'std' => '',
		'type' => 'text');
		
	$options[] = array(
		'name' => __('Slide2 Link URL', 'itransform'),
		'desc' => __('', 'itransform'),
		'id' => 'itrans_slide2_linkurl',
		'std' => '',
		'type' => 'text');		

	$options[] = array(
		'name' => __('Slide2 Image', 'itransform'),
		'desc' => __('Ideal image size width: 564px and height: 280px', 'itransform'),
		'id' => 'itrans_slide2_image',
		'std' => '',
		'type' => 'upload');



	$options[] = array(
		'name' => __('Slide3 Title', 'itransform'),
		'desc' => __('', 'itransform'),
		'id' => 'itrans_slide3_title',
		'std' => '',
		'type' => 'text');

	$options[] = array(
		'name' => __('Slide3 Description', 'itransform'),
		'desc' => __('', 'itransform'),
		'id' => 'itrans_slide3_desc',
		'std' => '',
		'type' => 'textarea');

	$options[] = array(
		'name' => __('Slide3 Link text', 'itransform'),
		'desc' => __('', 'itransform'),
		'id' => 'itrans_slide3_linktext',
		'std' => '',
		'type' => 'text');
		
	$options[] = array(
		'name' => __('Slide3 Link URL', 'itransform'),
		'desc' => __('', 'itransform'),
		'id' => 'itrans_slide3_linkurl',
		'std' => '',
		'type' => 'text');		

	$options[] = array(
		'name' => __('Slide3 Image', 'itransform'),
		'desc' => __('Ideal image size width: 564px and height: 280px', 'itransform'),
		'id' => 'itrans_slide3_image',
		'std' => '',
		'type' => 'upload');



	$options[] = array(
		'name' => __('Slide4 Title', 'itransform'),
		'desc' => __('', 'itransform'),
		'id' => 'itrans_slide4_title',
		'std' => '',
		'type' => 'text');

	$options[] = array(
		'name' => __('Slide4 Description', 'itransform'),
		'desc' => __('', 'itransform'),
		'id' => 'itrans_slide4_desc',
		'std' => '',
		'type' => 'textarea');

	$options[] = array(
		'name' => __('Slide4 Link text', 'itransform'),
		'desc' => __('', 'itransform'),
		'id' => 'itrans_slide4_linktext',
		'std' => '',
		'type' => 'text');
		
	$options[] = array(
		'name' => __('Slide4 Link URL', 'itransform'),
		'desc' => __('', 'itransform'),
		'id' => 'itrans_slide4_linkurl',
		'std' => '',
		'type' => 'text');		

	$options[] = array(
		'name' => __('Slide4 Image', 'itransform'),
		'desc' => __('Ideal image size width: 564px and height: 280px', 'itransform'),
		'id' => 'itrans_slide4_image',
		'std' => '',
		'type' => 'upload');


	return $options;
}
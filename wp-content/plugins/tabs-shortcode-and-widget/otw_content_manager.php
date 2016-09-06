<?php
/**
Plugin Name: Tabs Shortcode And Widgets
Plugin URI: http://OTWthemes.com
Description:  Create Tabs. Nice and easy interface. Insert anywhere in your site - page/post editor, sidebars, template files. 
Author: OTWthemes.com
Version: 1.6

Author URI: http://themeforest.net/user/OTWthemes
*/

load_plugin_textdomain('otw_tsw',false,dirname(plugin_basename(__FILE__)) . '/languages/');

$wp_tsw_tmc_items = array(
	'page'              => array( array(), __( 'Pages', 'otw_tsw' ) ),
	'post'              => array( array(), __( 'Posts', 'otw_tsw' ) )
);

$wp_tsw_agm_items = array(
	'page'              => array( array(), __( 'Pages', 'otw_tsw' ) ),
	'post'              => array( array(), __( 'Posts', 'otw_tsw' ) )
);

$wp_tsw_cs_items = array(
	'page'              => array( array(), __( 'Pages', 'otw_tsw' ) ),
	'post'              => array( array(), __( 'Posts', 'otw_tsw' ) )
);

$otw_tsw_plugin_url = plugin_dir_url( __FILE__);
$otw_tsw_css_version = '1.0';

//include functons
require_once( plugin_dir_path( __FILE__ ).'/include/otw_tsw_functions.php' );

//otw components
$otw_tsw_shortcode_component = false;
$otw_tsw_form_component = false;
$otw_tsw_validator_component = false;

//load core component functions
@include_once( 'include/otw_components/otw_functions/otw_functions.php' );

if( !function_exists( 'otw_register_component' ) ){
	wp_die( 'Please include otw components' );
}

//register form component
otw_register_component( 'otw_form', dirname( __FILE__ ).'/include/otw_components/otw_form/', $otw_tsw_plugin_url.'/include/otw_components/otw_form/' );

//register validator component
otw_register_component( 'otw_validator', dirname( __FILE__ ).'/include/otw_components/otw_validator/', $otw_tsw_plugin_url.'/include/otw_components/otw_validator/' );

//register shortcode component
otw_register_component( 'otw_shortcode', dirname( __FILE__ ).'/include/otw_components/otw_shortcode/', $otw_tsw_plugin_url.'/include/otw_components/otw_shortcode/' );

/** 
 *call init plugin function
 */
add_action('init', 'otw_tsw_init' );
add_action('widgets_init', 'otw_tsw_widgets_init' );

?>
<?php
/**
 * @package WordPress
 * @subpackage GoPress Theme
 */


/*-----------------------------------------------------------------------------------*/
/* REGISTER Admin */
/*-----------------------------------------------------------------------------------*/
function gopress_theme_settings_init(){
	register_setting( 'gopress_theme_settings', 'gopress_theme_settings' );
}


// add js for admin
function gopress_scripts() {
	wp_enqueue_script('media-upload');
	wp_enqueue_script('thickbox');
}
//add css for admin
function gopress_style() {
	wp_enqueue_style('thickbox');
}
function gopress_echo_scripts()
{
?>

<script type="text/javascript">
//<![CDATA[
jQuery(document).ready(function() {

// Media Uploader
window.formfield = '';

jQuery('.upload_image_button').live('click', function() {
	window.formfield = jQuery('.upload_field',jQuery(this).parent());
	tb_show('', 'media-upload.php?type=image&TB_iframe=true');
	return false;
});

window.original_send_to_editor = window.send_to_editor;
window.send_to_editor = function(html) {
	if (window.formfield) {
		imgurl = jQuery('img',html).attr('src');
		window.formfield.val(imgurl);
		tb_remove();
	}
	else {
		window.original_send_to_editor(html);
	}
	window.formfield = '';
	window.imagefield = false;
}

});
//]]> 
</script>
<?php
}

if (isset($_GET['page']) && $_GET['page'] == 'gopress-settings') {
	add_action('admin_print_scripts', 'gopress_scripts'); 
	add_action('admin_print_styles', 'gopress_style');
	add_action('admin_head', 'gopress_echo_scripts');
}


function gopress_add_settings_page() {
add_theme_page( __( 'gopress' ), __( 'Theme Settings' ), 'manage_options', 'gopress-settings', 'gopress_theme_settings_page');
}

add_action( 'admin_init', 'gopress_theme_settings_init' );
add_action( 'admin_menu', 'gopress_add_settings_page' );

function gopress_theme_settings_page() {
	
global $slider_effects;
?>


<?php 
/*-----------------------------------------------------------------------------------*/
/* START Admin */
/*-----------------------------------------------------------------------------------*/
?>

<div class="wrap">

<?php
// If the form has just been submitted, this shows the notification
if ( $_GET['settings-updated'] ) { ?>
<div id="message" class="updated fade gopress-message"><p><?php _e('Options Saved','gopress'); ?></p></div>
<?php } ?>

<div id="icon-options-general" class="icon32"></div>
<h2><?php _e( 'Theme Settings' ) ?></h2>

<form method="post" action="options.php">

<?php settings_fields( 'gopress_theme_settings' ); ?>
<?php $options = get_option( 'gopress_theme_settings' ); ?>

<table class="form-table">  

<tr valign="top">
<th scope="row"><?php _e( 'Favicon', 'gopress' ); ?></th>
<td>
<input id="gopress_theme_settings[favicon]" class="regular-text" type="text" size="36" name="gopress_theme_settings[favicon]" value="<?php esc_attr_e( $options['favicon'] ); ?>" />
<br />
<label class="description abouttxtdescription" for="gopress_theme_settings[favicon]"><?php _e( 'Upload or type in the URL for the site favicon.' ); ?></label>
</td>
</tr>

<tr valign="top">
<th scope="row"><?php _e( 'Logo', 'gopress' ); ?></th>
<td>
<input id="gopress_theme_settings[upload_mainlogo]" class="regular-text upload_field" type="text" size="36" name="gopress_theme_settings[upload_mainlogo]" value="<?php esc_attr_e( $options['upload_mainlogo'] ); ?>" />
<input class="upload_image_button button-secondary" type="button" value="Upload Image" />
<br />
<label class="description abouttxtdescription" for="gopress_theme_settings[logo]"><?php _e( 'Upload or type in the URL for the site logo.' ); ?></label>
</td>
</tr>

<tr valign="top">
<th scope="row"><?php _e( 'Logo Top margin', 'gopress' ); ?></th>
<td>
<input id="gopress_theme_settings[logo_margin]" class="regular-text" type="text" size="36" name="gopress_theme_settings[logo_margin]" value="<?php esc_attr_e( $options['logo_margin'] ); ?>" />
<br />
<label class="description abouttxtdescription" for="gopress_theme_settings[logo_margin]"><?php _e( 'Enter a px value for your logo top margin.' ); ?></label>
</td>
</tr>


<tr valign="top">
<th scope="row"><?php _e( 'Header Banner', 'gopress' ); ?></th>
<td>
<textarea id="gopress_theme_settings[header_banner]" class="regular-text" name="gopress_theme_settings[header_banner]" rows="5" cols="45"><?php esc_attr_e( $options['header_banner'] ); ?></textarea>
<br />
<label class="description abouttxtdescription" for="gopress_theme_settings[header_banner]"><?php _e( 'Enter your banner code here for the header.', 'gopress' ); ?></label>
</td>


<tr valign="top">
<th scope="row">Theme Credits</th>
<td><p>The <a href="http://www.wpexplorer.com/gopress-wordpress-theme.html" target="_blank">Gopress</a> Theme was created by AJ from <a href="http://www.wpexplorer.com/wpexplorer-tf" target="_blank"><strong>WPExplorer</strong></a><br />
</p>
</td>
</tr>

</table>
<p class="submit-changes">
<input type="submit" class="button-primary" value="<?php _e( 'Save Options' ); ?>" />
</p>
</form>
</div><!-- END wrap -->

<?php
}
//sanitize and validate
function gopress_options_validate( $input ) {
	global $select_options, $radio_options;
	if ( ! isset( $input['option1'] ) )
		$input['option1'] = null;
	$input['option1'] = ( $input['option1'] == 1 ? 1 : 0 );
	$input['sometext'] = wp_filter_nohtml_kses( $input['sometext'] );
	if ( ! isset( $input['radioinput'] ) )
		$input['radioinput'] = null;
	if ( ! array_key_exists( $input['radioinput'], $radio_options ) )
		$input['radioinput'] = null;
	$input['sometextarea'] = wp_filter_post_kses( $input['sometextarea'] );

	return $input;
}

?>
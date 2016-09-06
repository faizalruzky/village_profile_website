<?php
/**
 * @package WordPress
 * @subpackage GoPress Theme
 */
$options = get_option( 'gopress_theme_settings' );
?>
<?php get_header(); ?>
<?php if (have_posts()) : ?>


<div id="index" class="post clearfix">

	<?php
	$paged = $wp_query->get( 'paged' );
    if(!$paged) { require( TEMPLATEPATH . '/includes/slides.php'); } ?>
        
	<?php get_template_part( 'loop', 'entry') ?>     
</div>

<?php get_sidebar(); ?>
<?php pagination(); ?>
<?php endif; ?>
<?php get_footer(); ?>
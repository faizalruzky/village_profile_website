<?php
/**
 * @package WordPress
 * @subpackage GoPress Theme
 */
?>
<?php get_header(); ?>

<div id="page-heading">
    <h1 class="page-title"><?php _e('404 Error','gopress'); ?></h1>		
</div>
<!-- END page-heading -->

<div class="post clearfix">

<div class="entry clearfix">		
	<p><?php _e('Sorry, the page you were looking for could not be found.','gopress'); ?>.</p>
</div><!-- END entry -->

</div>
<!-- END post -->
<?php get_sidebar(); ?>
<?php get_footer(); ?>
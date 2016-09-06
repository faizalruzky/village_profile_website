<?php
/**
 * @package WordPress
 * @subpackage GoPress Theme
 */
?>
<?php get_header(); ?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

<div id="page-heading">
    <h1><?php the_title(); ?></h1>		
</div>
<!-- END page-heading -->

<div class="post clearfix">

    <div class="entry clearfix">	
    <?php the_content(); ?>
    <?php comments_template(); ?>  
	</div>
	<!-- END entry -->
    
</div>
<!-- END post -->

<?php endwhile; ?>
<?php endif; ?>	  
<?php get_sidebar(); ?>
<?php get_footer(); ?>
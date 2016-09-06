<?php
/**
 * @package WordPress
 * @subpackage GoPress Theme
 * Template Name: Full-Width
 */
?>

<?php get_header(); ?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>


<div id="page-heading">
    <h1><?php the_title(); ?></h1>		
</div>
<!-- END page-heading -->

<div class="post full-width clearfix">
<?php the_content(); ?>
<?php comments_template(); ?>
</div>
<!-- END .post -->
<?php endwhile; ?>
<?php endif; ?>
<?php get_footer(); ?>
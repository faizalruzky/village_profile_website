<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme and one of the
 * two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * For example, it puts together the home page when no home.php file exists.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage i-transform
 * @since i-transform 1.0
 */

get_header(); ?>
	<?php $do_not_duplicate = array(); ?>
	<div id="featured" class="featured-area clear">
		<div id="ft-post" class="ft-post">
		<?php if ( have_posts() ) : $counter=1; ?>
			<?php /* The loop for featured post */ ?>
			<?php while ( have_posts() ) : the_post(); ?>            	
            	<?php if ( is_sticky() && is_home() && $counter<=4 && ! is_paged() ) : ?>
                	<?php $do_not_duplicate[] = $post->ID ?>
                	<?php get_template_part( 'featured', get_post_format() ); ?>
                <?php endif; ?>
				<?php $counter++; ?>
			<?php endwhile; ?>
		<?php endif; ?>

		</div><!-- #content -->
	</div><!-- #primary -->
    
    
	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">
		<?php if ( have_posts() ) :  ?>
        	<div class="blog-columns">
			<?php /* The loop normal posts */ ?>
			<?php while ( have_posts() ) : the_post(); ?>
            	<?php if (in_array($post->ID, $do_not_duplicate)) continue; ?>
               	<?php get_template_part( 'content', get_post_format() ); ?>
			<?php endwhile; ?>
            </div>
			<?php itransform_paging_nav(); ?>
		<?php else : ?>
			<?php get_template_part( 'content', 'none' ); ?>
		<?php endif; ?>

		</div><!-- #content -->
        <?php get_sidebar(); ?>
	</div><!-- #primary -->


<?php get_footer(); ?>
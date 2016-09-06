<?php
/**
 * @package WordPress
 * @subpackage GoPress Theme
 */
?>
<?php get_header(); ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

<div class="post clearfix">
    <div class="entry clearfix">
    
		<div id="post-nextprev" class="clearfix">
			<div id="post-next" class="one-half"><?php next_post_link('&larr; %link'); ?></div>
        	<div id="post-prev" class="one-half remove-margin"><?php previous_post_link('%link &rarr;'); ?></div>
        </div>
        <!-- /post-next-prev -->
        
		<h1 class="single-title"><?php the_title(); ?></h1>
        <div class="post-meta single-meta">
            <?php _e('Posted On','gopress'); ?> <?php the_time('j'); ?> <?php the_time('M'); ?>, <?php the_time('Y'); ?> - <?php _e('By', 'gopress'); ?> <?php the_author_posts_link(); ?> - <?php _e('With', 'gopress'); ?> <?php comments_popup_link('0 Comments', '1 Comment', '% Comments'); ?>
        </div>
    
		<?php the_content(); ?>
        <div class="clear"></div>
        
        <?php wp_link_pages(' '); ?>
         
        <div class="post-bottom">
        	<?php the_tags('<div class="post-tags">',' , ','</div>'); ?>
        </div>
        <!-- END post-bottom -->
        
        
        </div>
        <!-- END entry -->
	
	<?php comments_template(); ?>
   
        
</div>
<!-- END post -->

<?php endwhile; ?>
<?php endif; ?>
             
<?php get_sidebar(); ?>
<?php get_footer(); ?>
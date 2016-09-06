<?php
$count=0;
while (have_posts()) : the_post();
$count++;
?>  


<?php
//design for pages
if ( get_post_type() == 'page') { ?>

    <div class="loop-entry clearfix <?php if($count =='2') { echo 'remove-margin'; } ?>">
    	<h2><a href="<?php the_permalink(' ') ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
    	<?php the_excerpt(); ?>
    </div><!-- END entry -->

<?php } else { ?>
<div class="loop-entry clearfix <?php if($count =='2') { echo 'remove-margin'; } ?>">

	<?php if ( has_post_thumbnail() ) {  ?>
        <div class="loop-entry-thumbnail">
			<a href="<?php the_permalink(' ') ?>" title="<?php the_title(); ?>"><?php the_post_thumbnail('post-image'); ?></a>
        </div>
    <?php } ?>
    
    	<h2><a href="<?php the_permalink(' ') ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
        <div class="post-meta">
        <?php _e('Posted On','gopress'); ?> <?php the_time('j'); ?> <?php the_time('M'); ?>, <?php the_time('Y'); ?> - <?php comments_popup_link('0 Comments', '1 Comment', '% Comments'); ?>
        </div>
    	<?php the_excerpt(''); ?>
     
</div><!-- END entry -->

<?php } ?>



<?php if($count =='2') { echo '<div class="clear"></div>'; $count=0; } endwhile; ?>
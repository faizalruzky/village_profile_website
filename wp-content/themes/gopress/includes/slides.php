<?php
/**
 * @package WordPress
 * @subpackage GoPress Theme
 */
?>


<?php
	global $data; //get theme options
	
	//get custom post type === > Slides
	global $post;
	$args = array(
		'post_type' =>'slides',
		'numberposts' => -1,
		'order' => 'ASC'
	);
	$slides = get_posts($args);
?>
<?php if($slides) { ?>
<div id="slider-wrap">
    <div id="home-slides" class="slides clearfix">
    	<div class="slides_container">
            <?php
            foreach($slides as $post) : setup_postdata($post);
			
			//image
            $featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'slider');
			
			//meta
            $slidelink = get_post_meta($post->ID, 'gopress_slides_url', TRUE);
			$slide_description = get_post_meta($post->ID, 'gopress_slides_description', TRUE);
			$enable_caption = get_post_meta($post->ID, 'gopress_enable_caption', TRUE);
            ?>
            	<?php if ( has_post_thumbnail() ) { ?>
            	<div class="slide">
                <?php if(!empty($slidelink)) { ?>
                    <a href="<?php echo $slidelink ?>" title="<?php the_title(); ?>"><img src="<?php echo $featured_image[0]; ?>" width="<?php echo $featured_image[1]; ?>" height="<?php echo $featured_image[2]; ?>" /></a>
                <?php } else { ?> 
                <img src="<?php echo $featured_image[0]; ?>" alt="<?php the_title(); ?>" width="<?php echo $featured_image[1]; ?>" height="<?php echo $featured_image[2]; ?>" />
                <?php } ?>
                <?php if(!empty($slide_description)) { ?>
				<div class="caption">
					<h3><?php the_title(); ?></h3>
                    <p> <?php echo $slide_description; ?></p>
				</div>
                <!-- /caption -->
                <?php } ?>
			</div><!--/slide -->
          <?php } endforeach; ?>
		</div><!-- /slides_container -->
    </div><!--/slides -->
</div>
<!-- /slider-wrap -->
<?php } ?>

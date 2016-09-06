<?php
/**
 * @package WordPress
 * @subpackage GoPress Theme
 */
?>
<?php get_header(' '); ?>

		<?php
        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
		query_posts($query_string .'&posts_per_page=10&paged=' . $paged);
		if (have_posts()) : ?>
        
        	 <div id="page-heading">
				<h1 id="archive-title">Search Results For: <?php the_search_query(); ?></h1>
            </div>
			<!-- END page-heading -->
            
			<div id="post" class="post clearfix">
            
            	<div id="archive">

				<?php get_template_part( 'loop' , 'entry') ?>
                
                </div>
        
        		<?php pagination();?>
        
			</div>
			<!-- END post  -->
        
		<?php else : ?>
        
			<div id="page-heading">
            <h1 id="archive-title">Search Results For "<?php the_search_query(); ?>"</h1>
        	</div>
            <!-- END page-heading -->
            
            <div id="post" class="post clearfix">
            <?php _e('No results found for that query.', 'gopress'); ?>
			</div>
			<!-- END post  -->
            
        <?php endif; ?>

<?php get_sidebar(' '); ?>		  
<?php get_footer(' '); ?>
<?php get_header(); ?>
<?php if (have_posts()) : ?>

<div id="page-heading">
		<?php
        if(isset($_GET['author_name'])) :
        $curauth = get_userdatabylogin($author_name);
        else :
        $curauth = get_userdata(intval($author));
        endif;
        ?>
        <h1><?php _e('Posts by','gopress'); ?>: <?php echo $curauth->nickname; ?></h1>		
</div>
<!-- END page-heading -->

<div id="post" class="post clearfix">  
	<div id="archive">  
		<?php
        // get post entry
        get_template_part('loop', 'entry') ?>    
        <?php pagination(); ?>
    </div>
</div>
<!-- END #post -->
<?php endif; ?>     
<?php get_sidebar(' '); ?>	   
<?php get_footer(' '); ?>
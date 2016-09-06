<?php
/**
 * @package WordPress
 * @subpackage GoPress Theme
 */
$options = get_option( 'gopress_theme_settings' );
?>
<div class="clear"></div>

	<div id="footer-wrap">
        <div id="footer">
        
            <div id="footer-widget-wrap" class="clearfix">
        
                <div id="footer-left">
                <?php dynamic_sidebar('footer-left'); ?>
                </div>
                
                <div id="footer-middle">
                 <?php dynamic_sidebar('footer-middle'); ?>
                </div>
                
                <div id="footer-right">
                 <?php dynamic_sidebar('footer-right'); ?>
                </div>
            
            </div>
		</div>
    </div>

	<div id="copyright" class="clearfix">
        
            <div class="one-half">
                &copy; <?php _e('Copyright', 'gopress'); ?><?php echo date('Y'); ?> <a href="<?php echo home_url(); ?>/" title="<?php bloginfo( 'name' ); ?>"><?php bloginfo( 'name' ) ?></a>
            </div>
            
            <div id="designby" class="one-half column-last">
            	<?php _e('design by','gopress'); ?> <a href="http://www.wpexplorer.com/" title="Premium WordPress Themes" target="_blank">WPExplorer</a>
            </div>
    
    </div>

</div>
<!-- END wrap --> 

<!-- WP Footer -->
<?php wp_footer(); ?>
</body>
</html>
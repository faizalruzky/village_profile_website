<?php 
/*
*      Robo Gallery     
*      Version: 1.2
*      By Robosoft
*
*      Contact: http://robosoft.co
*      Created: 2015
*      Licensed under the GPLv2 license - http://opensource.org/licenses/gpl-2.0.php
*
*      Copyright (c) 2014-2015, Robosoft. All rights reserved.
*      Available only in http://robosoft.co/
*/

?>
<div class="wrap">
	<h1  class="rbs-stats">
		<?php _e('Robo Gallery Statistics', 'rbs_gallery'); ?>
	</h1>
<br>

<?php 
	
if(!function_exists('rbs_stats_tabs')){
	function rbs_stats_tabs( $current = 'gallery' ) {
	    $tabs = array( 
	    		'gallery' => __('Gallery Statistics', 'rbs_gallery'), 
	    		'export' => __('Images Statistics', 'rbs_gallery') 
	    );
	    echo '<h2 class="nav-tab-wrapper">';
		    foreach( $tabs as $tab => $name ){
		        $class = ( $tab == $current ) ? ' nav-tab-active' : '';
		        echo "<a class='nav-tab$class' href='edit.php?post_type=robo_gallery_table&page=robo-gallery-stats&tab=$tab'>$name</a>";
		    }
	    echo '</h2>';
	}
}
$tab = 'gallery';
//if ( isset( $_GET['tab'] ) )  $tab = $_GET['tab'];
//if ( isset( $_POST['tab'] ) ) $tab = $_POST['tab'];
//rbs_stats_tabs( $tab);

$today = date("Y_j_n"); 
$countPosts = wp_count_posts(ROBO_GALLERY_TYPE_POST);

//var_dump($countPosts);

switch ($tab) {
	case 'gallery':
	?>
	<table class="form-table">
		<tbody>
			<tr>
				<th scope="row">
					<label ><?php _e('Published Galleries', 'rbs_gallery'); ?></label>
				</th>
				<td>
					<p><?php echo $countPosts->publish ; ?></p>
				</td>
			</tr>
			<tr>
				<th scope="row">
					<label ><?php _e('Galleries Drafts', 'rbs_gallery'); ?></label>
				</th>
				<td>
					<p><?php echo $countPosts->draft ; ?></p>
				</td>
			</tr>
			<tr>
				<th scope="row">
					<label ><?php _e('Galleries Trash', 'rbs_gallery'); ?></label>
				</th>
				<td>
					<p><?php echo $countPosts->trash ; ?></p>
				</td>
			</tr>
		</tbody>
	</table>
	<?php
		break;

	default:
 	case 'images':
?>
<?php 
	break;

	case 'import':

 } ?>
</div>
<?php 
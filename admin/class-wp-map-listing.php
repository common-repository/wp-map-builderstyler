<?php

/**
 * The admin-specific functionality of the plugin.
 *
 *  
 * @since      1.0.0
 *
 * @package    Wp_Map_Builder
 * @subpackage Wp_Map_Builder/admin
 */

/**
* Create map
*/
class Wbmmaplistpage extends Wp_Map_Builder_Admin
{
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	public function wbm_map_list_page(){
		global $wpdb;
		$wmb_table_name = $wpdb->prefix."wmb_map_builder";
		$wmb_get_row_query = "SELECT * FROM ".$wmb_table_name." ";
		$wmb_get_row_res = $wpdb->get_results($wmb_get_row_query);
		?>
		<div class="wrap">
			<h1 class="wp-heading-inline">Maps</h1>
			<a href="<?php echo admin_url().'admin.php?page=wbm_create_new_map'; ?>" class="page-title-action">Add New</a>
			<table id="wbm_map_table" class="wp-list-table widefat fixed striped posts">
				<thead>
					<tr>
						<th class="manage-column column-cb">Title</th>
						<th class="manage-column column-cb">Display Address</th>
						<th class="manage-column column-cb" width="200">Shortcode</th>
						<th class="manage-column column-cb">lat/long</th>
						<th class="manage-column column-cb">Action</th>
					</tr>
				</thead>
				<?php
				if(!empty($wmb_get_row_res)){
					for ($wbm_i=0; $wbm_i < count($wmb_get_row_res) ; $wbm_i++) { 
						$wmb_uid = $wmb_get_row_res[$wbm_i]->wmb_uid;
						$wmb_map_title = $wmb_get_row_res[$wbm_i]->wmb_map_title;
						$wmb_address = $wmb_get_row_res[$wbm_i]->wmb_address;
						$wmb_iconurl = $wmb_get_row_res[$wbm_i]->wmb_iconurl;
						$wmb_latitude = $wmb_get_row_res[$wbm_i]->wmb_latitude;
						$wmb_longitude = $wmb_get_row_res[$wbm_i]->wmb_longitude;
						$wmb_zoom_level = $wmb_get_row_res[$wbm_i]->wmb_zoom_level;
						$wmb_style_type = $wmb_get_row_res[$wbm_i]->wmb_style_type;
						?>
						<tr>
							<td><?php echo $wmb_map_title; ?></td>
							<td><?php echo $wmb_address; ?></td>
							<td><input style="width: 100%;" readonly="" value='[wmb_show_map id="<?php echo $wmb_uid; ?>"]' type="text"></td>
							<td><?php echo $wmb_latitude; ?>/<?php echo $wmb_longitude; ?></td>
							<td><a href="<?php echo admin_url()."admin.php?page=wbm_create_new_map&map_id=".$wmb_uid; ?>">Edit</a></td>
						</tr>
						<?php
					}
				}
				?>
			</table>
			<br class="clear">
		</div>
		<script type="text/javascript">
			jQuery(document).ready(function() {
			    jQuery('#wbm_map_table').DataTable();
			} );
		</script>
		<?php

	}
}
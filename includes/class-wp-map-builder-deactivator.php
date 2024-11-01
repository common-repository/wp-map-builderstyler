<?php

/**
 * Fired during plugin deactivation
 *
 *  
 * @since      1.0.0
 *
 * @package    Wp_Map_Builder
 * @subpackage Wp_Map_Builder/includes
 */

/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since      1.0.0
 * @package    Wp_Map_Builder
 * @subpackage Wp_Map_Builder/includes
 * @author     Mak <mikehost57@gmail.com>
 */
class Wp_Map_Builder_Deactivator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function deactivate() {
		global $wpdb;
		$wmb_table_name = $wpdb->prefix."wmb_map_builder";
		$wpdb->query( "DROP TABLE IF EXISTS ".$wmb_table_name." " );
		delete_option('wmb_key');
	}

}

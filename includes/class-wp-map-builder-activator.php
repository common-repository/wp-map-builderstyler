<?php

/**
 * Fired during plugin activation
 *
 *  
 * @since      1.0.0
 *
 * @package    Wp_Map_Builder
 * @subpackage Wp_Map_Builder/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Wp_Map_Builder
 * @subpackage Wp_Map_Builder/includes
 * @author     Mak <mikehost57@gmail.com>
 */
class Wp_Map_Builder_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
		global $wpdb;

		$charset_collate = $wpdb->get_charset_collate();
		$wmb_table_name = $wpdb->prefix."wmb_map_builder";
		$sql = "CREATE TABLE ".$wmb_table_name." (
		  id mediumint(9) NOT NULL AUTO_INCREMENT,
		  wmb_uid int(25) NOT NULL,
		  wmb_map_title tinytext NOT NULL,
		  wmb_latitude varchar(25) DEFAULT '' NOT NULL,
		  wmb_longitude varchar(25) DEFAULT '' NOT NULL,
		  wmb_iconurl varchar(205) DEFAULT '' NOT NULL,
		  wmb_address varchar(205) DEFAULT '' NOT NULL,
		  wmb_zoom_level varchar(25) DEFAULT '10' NOT NULL,
		  wmb_style_type int(25) DEFAULT '1' NOT NULL,
		  created_date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
		  PRIMARY KEY  (id)
		) $charset_collate;";
		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		dbDelta( $sql );
	}

}

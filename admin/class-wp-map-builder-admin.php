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
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Wp_Map_Builder
 * @subpackage Wp_Map_Builder/admin
 * @author     Mak <mikehost57@gmail.com>
 */
class Wp_Map_Builder_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Wp_Map_Builder_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wp_Map_Builder_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/wp-map-builder-admin.css', array(), $this->version, 'all' );
		wp_enqueue_style( $this->plugin_name."_datatable", plugin_dir_url( __FILE__ ) . 'css/jquery.dataTables.min.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Wp_Map_Builder_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wp_Map_Builder_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/wp-map-builder-admin.js', array( 'jquery' ), $this->version, false );
		wp_localize_script( $this->plugin_name, 'script_url',array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );
		wp_localize_script( $this->plugin_name, 'script_action',array( 'ajax_action' => 'update_create_map' ) );
		wp_enqueue_script( $this->plugin_name."_datatable", plugin_dir_url( __FILE__ ) . 'js/jquery.dataTables.min.js', array( 'jquery' ), $this->version, false );

	}

	public function wmb_admin_menu(){
		add_menu_page('WP Map Builder', 'WP Map Builder', 'manage_options', 'wbm_map_init_page', array( $this->wbmmapinitpage,'wbm_map_init_page'), plugin_dir_url(__FILE__).'images/icon.png');
		add_submenu_page( 'wbm_map_init_page', 'Create New Map', 'Create New Map','manage_options', 'wbm_create_new_map', array( $this->createnewmap,'wbm_create_new_map' ));
		add_submenu_page( 'wbm_map_init_page', 'Map List', 'Map List','manage_options', 'wbm_map_list_page', array( $this->wbmmaplistpage,'wbm_map_list_page' ));
	}

	public function update_create_map(){
		global $wpdb;
		$wmb_table_name = $wpdb->prefix."wmb_map_builder";
		
		$wmb_uid = sanitize_text_field($_POST['wmb_uid']);
		$wmb_action_status = sanitize_text_field($_POST['wmb_action_status']);
		$wmb_map_title = sanitize_text_field($_POST['wmb_map_title']); 
		$wmb_address = sanitize_text_field($_POST['wmb_address']);
		$wmb_iconurl = sanitize_text_field($_POST['wmb_iconurl']); 
		$wmb_latitude = sanitize_text_field($_POST['wmb_latitude']); 
		$wmb_longitude = sanitize_text_field($_POST['wmb_longitude']); 
		$wmb_zoom_level = sanitize_text_field($_POST['wmb_zoom_level']); 
		$wmb_style_type = sanitize_text_field($_POST['wmb_style_type']); 

		if($wmb_action_status=="0"){
			$wpdb->insert( 
				$wmb_table_name, 
				array( 
					'wmb_uid' => $wmb_uid,
					'wmb_map_title' => $wmb_map_title,
					'wmb_address' => $wmb_address,
					'wmb_iconurl' => $wmb_iconurl,
					'wmb_latitude' => $wmb_latitude,
					'wmb_longitude' => $wmb_longitude,
					'wmb_zoom_level' => $wmb_zoom_level,
					'wmb_style_type' => $wmb_style_type
				), 
				array( 
					'%s', 
					'%s', 
					'%s', 
					'%s', 
					'%s', 
					'%s', 
					'%s', 
					'%s', 
					'%s'
				) 
			);
		}
		else if($wmb_action_status=="1"){
			$wpdb->update( 
				$wmb_table_name, 
				array( 
					'wmb_map_title' => $wmb_map_title,
					'wmb_address' => $wmb_address,
					'wmb_iconurl' => $wmb_iconurl,
					'wmb_latitude' => $wmb_latitude,
					'wmb_longitude' => $wmb_longitude,
					'wmb_zoom_level' => $wmb_zoom_level,
					'wmb_style_type' => $wmb_style_type
				),
				array( 'wmb_uid' => $wmb_uid ), 
				array( 
					'%s', 
					'%s', 
					'%s', 
					'%s', 
					'%s', 
					'%s', 
					'%s', 
					'%s'
				), 
				array( '%d' ) 
			);
		}
		else if($wmb_action_status=="delete"){
			$wpdb->delete( 
				$wmb_table_name, 
				array( 
					'wmb_uid' => $wmb_uid
				), 
				array( 
					'%s', 
				) 
			);
		}
		exit();
	}

}
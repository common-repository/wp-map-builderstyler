<?php

/**
* Shortcode Helper
*/
class WMB_Show_Map
{
    private $var = 'show_map_function';

    public function show_map_function($attr)
    {
    	global $wpdb;
    	$wmb_table_name = $wpdb->prefix."wmb_map_builder";
    	$map_id = $attr['id'];
    	
		$wmb_get_map_query = "SELECT * FROM ".$wmb_table_name." WHERE wmb_uid = '".$map_id."' ";
		$wmb_get_map_res = $wpdb->get_row($wmb_get_map_query);
		if(isset($wmb_get_map_res) && !empty($wmb_get_map_res)){
			$wmb_map_title = $wmb_get_map_res->wmb_map_title;
			$wmb_latitude = $wmb_get_map_res->wmb_latitude;
			$wmb_longitude = $wmb_get_map_res->wmb_longitude;
			$wmb_iconurl = $wmb_get_map_res->wmb_iconurl;
			$wmb_address = $wmb_get_map_res->wmb_address;
			$wmb_zoom_level = $wmb_get_map_res->wmb_zoom_level;
			$wmb_style_type = $wmb_get_map_res->wmb_style_type;
	    	ob_start();
	    	wp_enqueue_script( 'wmb_map_style'.$wmb_style_type, plugin_dir_url( __FILE__ ) . 'js/map_style'.$wmb_style_type.'.js', array(), null );
	    	wp_localize_script( 'wmb_map_style'.$wmb_style_type, 'wmb_map_style_obj', array(
			    'map_id' => $map_id,
			    'wmb_latitude' => $wmb_latitude,
			    'wmb_longitude' => $wmb_longitude,
			    'wmb_zoom_level' => $wmb_zoom_level,
			    'wmb_address' => $wmb_address,
			));
	    	?>
			<div id="googleMap_<?php echo $map_id; ?>" style="width:100%;height:400px;"></div>
			<?php
	    	return ob_get_clean();
    	}
    }
}

$WMB_Show_Map = new WMB_Show_Map;

add_shortcode( 'wmb_show_map', array( $WMB_Show_Map, 'show_map_function' ) );
?>
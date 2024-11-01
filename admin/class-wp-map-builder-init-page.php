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
class Wbmmapinitpage extends Wp_Map_Builder_Admin
{
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	public function wbm_map_init_page(){
		global $wpdb;
		?>
		<div class="wrap wmb_box">
		   <h1 class="wp-heading-inline">Get Started with customize your map</h1>
		
		<?php 
		if(isset($_POST['wmb_key']) && $_POST['wmb_key'] != "" ){
			update_option('wmb_key',sanitize_text_field($_POST['wmb_key']) );
			?>
			<div id="message" class="updated notice notice-success is-dismissible" style="">
				<p>Google Map API Key Updated Successfully.</p>
			</div>
			<?php
		}
		?>
		   <hr class="wp-header-end">
		      <div id="poststuff">
		         <div id="post-body" class="metabox-holder columns-1 wmb_info_page">
		         	<div class="key_section">
		         		<form action="" method="post">
		         			<p>
		         				Before Starting creating & appling style to your map, Must needed to generate API key & Update it at here.
		         			</p>
		         			<?php $wmb_key = get_option('wmb_key'); ?>
			         		<label for="wmb_key"><?php if($wmb_key==""){ ?>Add <?php } ?>Your Google Map API Key : </label>
			         		<?php if($wmb_key!=""){ ?>
			         		<b><?php echo substr(esc_attr($wmb_key), 0,5)."_xxx-xxxxxxxxxxxx_".substr(esc_attr($wmb_key), -5); ?></b>
			         		<input type="text" required="" name="wmb_key" class="wp_inp_key" value="" placeholder="Update new Google Map Key">
			         		<?php }else{ ?>
			         		<input type="text" required="" name="wmb_key" class="wp_inp_key" value="" placeholder="Add your Google Map Key">
			         		<?php } ?>
			         		<input type="submit" value="Go" class="wp_sub_key">
		         		</form>
		         	</div>
		         		<hr>
	         		
			         	<div class="intro_sectoion">
			         		<h2 style="padding: 10px 0;">Need Help to Create Google Map API key,<br> Here is the detailed guide to getting an API key</h2>
							<p>Follow these steps to get an API key:</p>
							<ol>
							  <li>Go to the <a class="gc-analytics-event" data-category="getKey" data-action="linkClick" data-label="body" href="https://cloud.google.com/console/google/maps-apis/overview" target="blank">
							      Google Cloud Platform Console</a>.</li>
							  <li>
							    Create or select a project.
							  </li>
							  <li>
							    Click <strong>Continue</strong> to enable the API.
							  </li>
							  <li>
							    On the <strong>Credentials</strong> page, get an <strong>API key</strong>. <br>Note: If you have
							    an existing unrestricted API key, or a key with browser restrictions, you may use that key.
							  </li>
							  <li>
							    From the dialog displaying the API key, select <strong>Restrict key</strong> to set a browser
							    restriction on the API key.
							  </li>
							  <li>
							    In the <strong>Key restriction</strong> section, select
							    <strong>HTTP referrers (web sites)</strong>, then follow the on-screen instructions to set
							    referrers, then click <strong>Save</strong>. Read more about
							    <a href="#key-restrictions">restricting API keys</a>.
							  </li>
							</ol>
			         	</div>
			        
		         </div>
		     </div>
		 </div>
		<?php
	}
}
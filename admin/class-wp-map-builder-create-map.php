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
class Createnewmap extends Wp_Map_Builder_Admin
{
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	public function wbm_create_new_map(){
		global $wpdb;
		$wmb_table_name = $wpdb->prefix."wmb_map_builder";

		if(isset($_GET['map_id']) && $_GET['map_id'] !=""){
			$wmb_uid = sanitize_text_field($_GET['map_id']);
			$wmb_action_status = "1";
		}
		else{
			$wmb_uid = rand(00000,99999);
			$wmb_action_status = "0";
		}
		$wmb_map_title = ""; 
		$wmb_address = "";
		$wmb_iconurl = ""; 
		$wmb_latitude = ""; 
		$wmb_longitude = ""; 
		$wmb_zoom_level = ""; 
		$wmb_style_type = ""; 
		if($wmb_action_status=="1"){
			$wmb_get_row_query = "SELECT * FROM ".$wmb_table_name." WHERE wmb_uid = '".$wmb_uid."' ";
			$wmb_get_row_res = $wpdb->get_row($wmb_get_row_query);
			$wmb_map_title = $wmb_get_row_res->wmb_map_title;
			$wmb_address = $wmb_get_row_res->wmb_address;
			$wmb_iconurl = $wmb_get_row_res->wmb_iconurl;
			$wmb_latitude = $wmb_get_row_res->wmb_latitude;
			$wmb_longitude = $wmb_get_row_res->wmb_longitude;
			$wmb_zoom_level = $wmb_get_row_res->wmb_zoom_level;
			$wmb_style_type = $wmb_get_row_res->wmb_style_type;
		}
		?>
		<script src="https://maps.googleapis.com/maps/api/js?key=<?php echo get_option('wmb_key'); ?>&libraries=places&callback=myMap" defer></script>
		<div class="wrap wmb_box">
		   <h1 class="wp-heading-inline"><?php if($wmb_action_status=="1"){ ?>Edit <?php }else{ ?>Add <?php } ?>Style to Your Map</h1>
			<div id="message" class="" style="display: none;">
				<p></p>
			</div>

		   <hr class="wp-header-end">
		      <div id="poststuff">
		         <div id="post-body" class="metabox-holder columns-2">
		            <div id="post-body-content" style="position: relative;">
		               
		               		<input type="hidden" name="wmb_uid" id="wmb_uid" value="<?php echo $wmb_uid; ?>" >
		               		<input type="hidden" name="wmb_action_status" id="wmb_action_status" value="<?php echo $wmb_action_status; ?>" >
		                  <div id="titlewrap">
		                     <input name="wmb_map_title" id="wmb_map_title" placeholder="Enter Map Title here" size="30" spellcheck="true" autocomplete="off" type="text" value="<?php echo $wmb_map_title; ?>" >
		                  </div>
		                  <div>
		                  	<textarea name="wmb_address" id="wmb_address" placeholder="Display Map Address" style="width: 100%;height: 100px;"><?php echo $wmb_address; ?></textarea>
		                  </div>
		                  <div>
		                  	<input type="hidden" placeholder="Add Your map icon URL" name="wmb_iconurl" id="wmb_iconurl" value="<?php echo $wmb_iconurl; ?>" >
		                  </div>
		                  <div>
		                  	<div class="devide">
		                  		<div class="def_map">
				                  	<label>
									  <input type="radio" name="wmb_style_type" value="25" <?php if($wmb_style_type == "25"){ echo "checked"; $a_class ="active"; }else{ $a_class =""; } ?>>
									  <img src="<?php echo plugin_dir_url(__FILE__)."images/public/25.png"; ?>" class="<?php echo $a_class; ?>">
									</label>
		                  		</div>
		                  	</div>
		                  	<div class="devide">
		                  		<div class="def_map">
				                  	<label>
									  <input type="radio" name="wmb_style_type" value="13" <?php if($wmb_style_type == "13"){ echo "checked"; $a_class ="active"; }else{ $a_class =""; } ?>>
									  <img src="<?php echo plugin_dir_url(__FILE__)."images/public/13.png"; ?>" class="<?php echo $a_class; ?>">
									</label>
		                  		</div>
		                  	</div>
		                  	<div class="devide">
		                  		<div class="def_map">
				                  	<label>
									  <input type="radio" name="wmb_style_type" value="14" <?php if($wmb_style_type == "14"){ echo "checked"; $a_class ="active"; }else{ $a_class =""; } ?>>
									  <img src="<?php echo plugin_dir_url(__FILE__)."images/public/14.png"; ?>" class="<?php echo $a_class; ?>">
									</label>
		                  		</div>
		                  	</div>
		                  	<div class="devide">
		                  		<div class="def_map">
				                  	<label>
									  <input type="radio" name="wmb_style_type" value="15" <?php if($wmb_style_type == "15"){ echo "checked"; $a_class ="active"; }else{ $a_class =""; } ?>>
									  <img src="<?php echo plugin_dir_url(__FILE__)."images/public/15.png"; ?>" class="<?php echo $a_class; ?>">
									</label>
		                  		</div>
		                  	</div>
		                  	<div class="devide">
		                  		<div class="def_map">
				                  	<label>
									  <input type="radio" name="wmb_style_type" value="16" <?php if($wmb_style_type == "16"){ echo "checked"; $a_class ="active"; }else{ $a_class =""; } ?>>
									  <img src="<?php echo plugin_dir_url(__FILE__)."images/public/16.png"; ?>" class="<?php echo $a_class; ?>">
									</label>
		                  		</div>
		                  	</div>
		                  	<div class="devide">
		                  		<div class="def_map">
				                  	<label>
									  <input type="radio" name="wmb_style_type" value="17" <?php if($wmb_style_type == "17"){ echo "checked"; $a_class ="active"; }else{ $a_class =""; } ?>>
									  <img src="<?php echo plugin_dir_url(__FILE__)."images/public/17.png"; ?>" class="<?php echo $a_class; ?>">
									</label>
		                  		</div>
		                  	</div>
		                  	<div class="devide">
		                  		<div class="def_map">
				                  	<label>
									  <input type="radio" name="wmb_style_type" value="18" <?php if($wmb_style_type == "18"){ echo "checked"; $a_class ="active"; }else{ $a_class =""; } ?>>
									  <img src="<?php echo plugin_dir_url(__FILE__)."images/public/18.png"; ?>" class="<?php echo $a_class; ?>">
									</label>
		                  		</div>
		                  	</div>
		                  	<div class="devide">
		                  		<div class="def_map">
				                  	<label>
									  <input type="radio" name="wmb_style_type" value="19" <?php if($wmb_style_type == "19"){ echo "checked"; $a_class ="active"; }else{ $a_class =""; } ?>>
									  <img src="<?php echo plugin_dir_url(__FILE__)."images/public/19.png"; ?>" class="<?php echo $a_class; ?>">
									</label>
		                  		</div>
		                  	</div>
		                  	<div class="devide">
		                  		<div class="def_map">
				                  	<label>
									  <input type="radio" name="wmb_style_type" value="20" <?php if($wmb_style_type == "20"){ echo "checked"; $a_class ="active"; }else{ $a_class =""; } ?>>
									  <img src="<?php echo plugin_dir_url(__FILE__)."images/public/20.png"; ?>" class="<?php echo $a_class; ?>">
									</label>
		                  		</div>
		                  	</div>
		                  	<div class="devide">
		                  		<div class="def_map">
				                  	<label>
									  <input type="radio" name="wmb_style_type" value="21" <?php if($wmb_style_type == "21"){ echo "checked"; $a_class ="active"; }else{ $a_class =""; } ?>>
									  <img src="<?php echo plugin_dir_url(__FILE__)."images/public/21.png"; ?>" class="<?php echo $a_class; ?>">
									</label>
		                  		</div>
		                  	</div>
		                  	<div class="devide">
		                  		<div class="def_map">
				                  	<label>
									  <input type="radio" name="wmb_style_type" value="22" <?php if($wmb_style_type == "22"){ echo "checked"; $a_class ="active"; }else{ $a_class =""; } ?>>
									  <img src="<?php echo plugin_dir_url(__FILE__)."images/public/22.png"; ?>" class="<?php echo $a_class; ?>">
									</label>
		                  		</div>
		                  	</div>
		                  	<div class="devide">
		                  		<div class="def_map">
				                  	<label>
									  <input type="radio" name="wmb_style_type" value="23" <?php if($wmb_style_type == "23"){ echo "checked"; $a_class ="active"; }else{ $a_class =""; } ?>>
									  <img src="<?php echo plugin_dir_url(__FILE__)."images/public/23.png"; ?>" class="<?php echo $a_class; ?>">
									</label>
		                  		</div>
		                  	</div>
		                  	<div class="devide">
		                  		<div class="def_map">
				                  	<label>
									  <input type="radio" name="wmb_style_type" value="24" <?php if($wmb_style_type == "24"){ echo "checked"; $a_class ="active"; }else{ $a_class =""; } ?>>
									  <img src="<?php echo plugin_dir_url(__FILE__)."images/public/24.png"; ?>" class="<?php echo $a_class; ?>">
									</label>
		                  		</div>
		                  	</div>
		                  	<div class="devide">
		                  		<div class="def_map">
				                  	<label>
									  <input type="radio" name="wmb_style_type" value="1" <?php if($wmb_style_type == "1"){ echo "checked"; $a_class ="active"; }else{ $a_class =""; } ?>>
									  <img src="<?php echo plugin_dir_url(__FILE__)."images/public/1.png"; ?>" class="<?php echo $a_class; ?>">
									</label>
		                  		</div>
		                  	</div>
		                  	<div class="devide">
		                  		<div class="def_map">
				                  	<label>
									  <input type="radio" name="wmb_style_type" value="2" <?php if($wmb_style_type == "2"){ echo "checked"; $a_class ="active"; }else{ $a_class =""; } ?>>
									  <img src="<?php echo plugin_dir_url(__FILE__)."images/public/2.png"; ?>" class="<?php echo $a_class; ?>">
									</label>
		                  		</div>
		                  	</div>
		                  	<div class="devide">
		                  		<div class="def_map">
				                  	<label>
									  <input type="radio" name="wmb_style_type" value="3" <?php if($wmb_style_type == "3"){ echo "checked"; $a_class ="active"; }else{ $a_class =""; } ?>>
									  <img src="<?php echo plugin_dir_url(__FILE__)."images/public/3.png"; ?>" class="<?php echo $a_class; ?>">
									</label>
		                  		</div>
		                  	</div>
		                  	<div class="devide">
		                  		<div class="def_map">
				                  	<label>
									  <input type="radio" name="wmb_style_type" value="4" <?php if($wmb_style_type == "4"){ echo "checked"; $a_class ="active"; }else{ $a_class =""; } ?>>
									  <img src="<?php echo plugin_dir_url(__FILE__)."images/public/4.png"; ?>" class="<?php echo $a_class; ?>">
									</label>
		                  		</div>
		                  	</div>
		                  	<div class="devide">
		                  		<div class="def_map">
				                  	<label>
									  <input type="radio" name="wmb_style_type" value="5" <?php if($wmb_style_type == "5"){ echo "checked"; $a_class ="active"; }else{ $a_class =""; } ?>>
									  <img src="<?php echo plugin_dir_url(__FILE__)."images/public/5.png"; ?>" class="<?php echo $a_class; ?>">
									</label>
		                  		</div>
		                  	</div>
		                  	<div class="devide">
		                  		<div class="def_map">
				                  	<label>
									  <input type="radio" name="wmb_style_type" value="6" <?php if($wmb_style_type == "6"){ echo "checked"; $a_class ="active"; }else{ $a_class =""; } ?>>
									  <img src="<?php echo plugin_dir_url(__FILE__)."images/public/6.png"; ?>" class="<?php echo $a_class; ?>">
									</label>
		                  		</div>
		                  	</div>
		                  	<div class="devide">
		                  		<div class="def_map">
				                  	<label>
									  <input type="radio" name="wmb_style_type" value="7" <?php if($wmb_style_type == "7"){ echo "checked"; $a_class ="active"; }else{ $a_class =""; } ?>>
									  <img src="<?php echo plugin_dir_url(__FILE__)."images/public/7.png"; ?>" class="<?php echo $a_class; ?>">
									</label>
		                  		</div>
		                  	</div>
		                  	<div class="devide">
		                  		<div class="def_map">
				                  	<label>
									  <input type="radio" name="wmb_style_type" value="8" <?php if($wmb_style_type == "8"){ echo "checked"; $a_class ="active"; }else{ $a_class =""; } ?>>
									  <img src="<?php echo plugin_dir_url(__FILE__)."images/public/8.png"; ?>" class="<?php echo $a_class; ?>">
									</label>
		                  		</div>
		                  	</div>
		                  	<div class="devide">
		                  		<div class="def_map">
				                  	<label>
									  <input type="radio" name="wmb_style_type" value="9" <?php if($wmb_style_type == "9"){ echo "checked"; $a_class ="active"; }else{ $a_class =""; } ?>>
									  <img src="<?php echo plugin_dir_url(__FILE__)."images/public/9.png"; ?>" class="<?php echo $a_class; ?>">
									</label>
		                  		</div>
		                  	</div>
		                  	<div class="devide">
		                  		<div class="def_map">
				                  	<label>
									  <input type="radio" name="wmb_style_type" value="10" <?php if($wmb_style_type == "10"){ echo "checked"; $a_class ="active"; }else{ $a_class =""; } ?>>
									  <img src="<?php echo plugin_dir_url(__FILE__)."images/public/10.png"; ?>" class="<?php echo $a_class; ?>">
									</label>
		                  		</div>
		                  	</div>
		                  	<div class="devide">
		                  		<div class="def_map">
				                  	<label>
									  <input type="radio" name="wmb_style_type" value="11" <?php if($wmb_style_type == "11"){ echo "checked"; $a_class ="active"; }else{ $a_class =""; } ?>>
									  <img src="<?php echo plugin_dir_url(__FILE__)."images/public/11.png"; ?>" class="<?php echo $a_class; ?>">
									</label>
		                  		</div>
		                  	</div>
		                  	<div class="devide">
		                  		<div class="def_map">
				                  	<label>
									  <input type="radio" name="wmb_style_type" value="12" <?php if($wmb_style_type == "12"){ echo "checked"; $a_class ="active"; }else{ $a_class =""; } ?>>
									  <img src="<?php echo plugin_dir_url(__FILE__)."images/public/12.png"; ?>" class="<?php echo $a_class; ?>">
									</label>
		                  		</div>
		                  	</div>
		                  </div>
		               </div>

		            <div id="postbox-container-1" class="postbox-container">
		               <div id="side-sortables" class="meta-box-sortables ui-sortable" style="">

		               	<?php if($wmb_action_status=="0"){ $wmb_v = 'style="display:none;"'; }else{ $wmb_v = ""; } ?>
						<div id="submitdiv" class="wmb_shortcode postbox " <?php echo $wmb_v; ?>>
							<h2 class="hndle ui-sortable-handle"><span>Shortcode</span></h2>
							<div class="inside">
								<div class="submitbox" id="submitpost">
									<div>
										<input readonly="" value='[wmb_show_map id="<?php echo $wmb_uid; ?>"]' type="text">
									</div>
								</div>
							</div>
						</div>

		                  <div id="submitdiv" class="postbox ">
		                     <h2 class="hndle ui-sortable-handle"><span>Options</span></h2>
		                     <div class="inside">
		                        <div class="submitbox" id="submitpost">
				                  <div>
				                  	<!-- <a class="preview button" >Preview Map</a> -->
				                  	<label style="padding: 10px;font-size: 16px;font-style: italic;">Latitude</label>
				                  	<input type="text" name="wmb_latitude" id="wmb_latitude" placeholder="Latitude" value="<?php echo $wmb_latitude; ?>" >
				                  	<label style="padding: 10px;font-size: 16px;font-style: italic;">Longitude</label>
				                  	<input type="text" name="wmb_longitude" id="wmb_longitude" placeholder="Longitude" value="<?php echo $wmb_longitude; ?>" >
				                  	<label style="padding: 10px;font-size: 16px;font-style: italic;">Zoom Level</label>
				                  	<select name="wmb_zoom_level" id="wmb_zoom_level">
				                  		<option <?php if($wmb_zoom_level == '5'){ echo "selected='selected'"; } ?> value="5">5</option>
				                  		<option <?php if($wmb_zoom_level == '8'){ echo "selected='selected'"; } ?> value="8">8</option>
				                  		<option <?php if($wmb_zoom_level == '10'){ echo "selected='selected'"; } ?> value="10">10</option>
				                  		<option <?php if($wmb_zoom_level == '12'){ echo "selected='selected'"; } ?> value="12">12</option>
				                  		<option <?php if($wmb_zoom_level == '13'){ echo "selected='selected'"; } ?> value="13">13</option>
				                  		<option <?php if($wmb_zoom_level == '14'){ echo "selected='selected'"; } ?> value="14">14</option>
				                  		<option <?php if($wmb_zoom_level == '15'){ echo "selected='selected'"; } ?> value="15">15</option>
				                  		<option <?php if($wmb_zoom_level == '17'){ echo "selected='selected'"; } ?> value="17">17</option>
				                  		<option <?php if($wmb_zoom_level == '19'){ echo "selected='selected'"; } ?> value="19">19</option>
				                  		<option <?php if($wmb_zoom_level == '21'){ echo "selected='selected'"; } ?> value="21">21</option>
				                  	</select>
				                  	<br><br>
				                  </div>
		                           <div id="major-publishing-actions">
		                              <?php if($wmb_action_status=="1"){ ?>
		                              <div id="delete-action">
		                              	<a class="submitdelete deletion" onclick="wmb_delete_create_map();">Delete</a>
		                              </div>
		                              <?php } ?>
		                              <div id="publishing-action">
		                                 <span class="spinner"></span>
		                                 <a class="button button-primary button-large" onclick="wmb_update_create_map();" >Update</a>
		                              </div>
		                              <div class="clear"></div>
		                           </div>
		                        </div>
		                     </div>
		                  </div>
		               </div>
		            </div>
		         </div>
		      </div>
		</div>
		<style type="text/css">
			[type=radio] { 
  position: absolute;
  opacity: 0;
  width: 0;
  height: 0;
}

/* IMAGE STYLES */
[type=radio] + img {
  cursor: pointer;
}

/* CHECKED STYLES */
[type=radio]:checked + img {
  outline: 2px solid #f00;
}
.devide {
	width: 23%;
	float: left;
	margin: 1%;
	height: 125px;
}
.def_map img {
	width: 100%;
}
.devide input {
	width: auto;
}
		</style>
		<?php
	}
}
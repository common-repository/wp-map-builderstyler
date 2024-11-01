
// This example adds a search box to a map, using the Google Place Autocomplete
// feature. People can enter geographical searches. The search box will return a
// pick list containing a mix of places and predicted search terms.

// This example requires the Places library. Include the libraries=places
// parameter when you first load the API. For example:
// <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

function myMap() {
var image = 'https://maps.gstatic.com/mapfiles/api-3/images/spotlight-poi2.png';
var map = new google.maps.Map(document.getElementById('map'), {
  center: {lat: -33.8688, lng: 151.2195},
  zoom: 2,
  mapTypeId: 'roadmap'
});

// Create the search box and link it to the UI element.
var input = document.getElementById('pac-input');
var searchBox = new google.maps.places.SearchBox(input);
map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

// Bias the SearchBox results towards current map's viewport.
map.addListener('bounds_changed', function() {
  searchBox.setBounds(map.getBounds());
});

var markers = [];
// Listen for the event fired when the user selects a prediction and retrieve
// more details for that place.
searchBox.addListener('places_changed', function() {
  var places = searchBox.getPlaces();

var geocoder = new google.maps.Geocoder();
var address = document.getElementById('pac-input').value;
geocoder.geocode({ 'address': address }, function (results, status) {

    if (status == google.maps.GeocoderStatus.OK) {
        var latitude = results[0].geometry.location.lat();
        var longitude = results[0].geometry.location.lng();
		jQuery("#wmb_latitude").val(latitude);
		jQuery("#wmb_longitude").val(longitude);
    }
});
  if (places.length == 0) {
    return;
  }

  // Clear out the old markers.
  markers.forEach(function(marker) {
    marker.setMap(null);
  });
  markers = [];

  // For each place, get the icon, name and location.
  var bounds = new google.maps.LatLngBounds();
  places.forEach(function(place) {
    if (!place.geometry) {
      console.log("Returned place contains no geometry");
      return;
    }

    // Create a marker for each place.
    markers.push(new google.maps.Marker({
      map: map,
	  icon: image,
      title: place.name,
      position: place.geometry.location
    }));

    if (place.geometry.viewport) {
      // Only geocodes have viewport.
      bounds.union(place.geometry.viewport);
    } else {
      bounds.extend(place.geometry.location);
    }
  });
  map.fitBounds(bounds);
});
}

function validate_all() {
	if( jQuery("#wmb_uid").val() == "" ){
		jQuery("#wmb_uid").focus();
		jQuery("#wmb_uid").css("box-shadow","inset 0 0 3px red");
		return false();
	}
	if( jQuery("#wmb_action_status").val() == "" ){
		jQuery("#wmb_action_status").focus();
		jQuery("#wmb_action_status").css("box-shadow","inset 0 0 3px red");
		return false();
	}
	if( jQuery("#wmb_map_title").val() == "" ){
		jQuery("#wmb_map_title").focus();
		jQuery("#wmb_map_title").css("box-shadow","inset 0 0 3px red");
		return false();
	}
	if( jQuery("#wmb_address").val() == "" ){
		jQuery("#wmb_address").focus();
		jQuery("#wmb_address").css("box-shadow","inset 0 0 3px red");
		return false();
	}
	if( jQuery("#wmb_latitude").val() == "" ){
		jQuery("#wmb_latitude").focus();
		jQuery("#wmb_latitude").css("box-shadow","inset 0 0 3px red");
		return false();
	}
	if( jQuery("#wmb_longitude").val() == "" ){
		jQuery("#wmb_longitude").focus();
		jQuery("#wmb_longitude").css("box-shadow","inset 0 0 3px red");
		return false();
	}
	if( jQuery("#wmb_zoom_level").val() == "" ){
		jQuery("#wmb_zoom_level").focus();
		jQuery("#wmb_zoom_level").css("box-shadow","inset 0 0 3px red");
		return false();
	}
	jQuery("input[name='wmb_style_type']:checked").val()
}

function wmb_update_create_map(){
	validate_all();
	jQuery(".spinner").css('visibility','visible');
	jQuery("#message").removeClass('error');
	jQuery("#message").removeClass('success');
	jQuery("#message").removeClass('notice-success');
	jQuery("#message").removeClass('notice-error');
	var wmb_uid = jQuery("#wmb_uid").val();
	var wmb_action_status = jQuery("#wmb_action_status").val();
	var wmb_map_title = jQuery("#wmb_map_title").val();
	var wmb_address = jQuery("#wmb_address").val();
	var wmb_iconurl = jQuery("#wmb_iconurl").val();
	var wmb_latitude = jQuery("#wmb_latitude").val();
	var wmb_longitude = jQuery("#wmb_longitude").val();
	var wmb_zoom_level = jQuery("#wmb_zoom_level").val();
	var wmb_style_type = jQuery("input[name='wmb_style_type']:checked").val();
	jQuery.ajax({
		type: "POST",
		url: script_url.ajax_url,
		data: ({
			action: script_action.ajax_action,
			wmb_uid : wmb_uid,
			wmb_action_status : wmb_action_status,
			wmb_map_title : wmb_map_title,
			wmb_address : wmb_address,
			wmb_iconurl : wmb_iconurl,
			wmb_latitude : wmb_latitude,
			wmb_longitude : wmb_longitude,
			wmb_zoom_level : wmb_zoom_level,
			wmb_style_type : wmb_style_type
		}),
		success: function (response_line) {
			jQuery(".spinner").css('visibility','hidden');
			jQuery("#message").show();
			if(wmb_action_status=="0"){
				jQuery("#message").addClass('updated notice notice-success is-dismissible');
				jQuery("#message p").html("Map Added Successfully.");
				jQuery(".wmb_shortcode").show();
				
			}else{
				jQuery("#message").addClass('updated notice notice-success is-dismissible');
				jQuery("#message p").html("Map Updated Successfully.");
			}
		}
	});
}

function wmb_delete_create_map(){
	var r = confirm("Are you Sure want to delete map?");
	if (r == true) {
		jQuery(".spinner").css('visibility','visible');
		jQuery("#message").removeClass('error');
		jQuery("#message").removeClass('success');
		jQuery("#message").removeClass('notice-success');
		jQuery("#message").removeClass('notice-error');

		var wmb_uid = jQuery("#wmb_uid").val();
		var wmb_action_status = "delete";
		var wmb_map_title = jQuery("#wmb_map_title").val();
		var wmb_address = jQuery("#wmb_address").val();
		var wmb_iconurl = jQuery("#wmb_iconurl").val();
		var wmb_latitude = jQuery("#wmb_latitude").val();
		var wmb_longitude = jQuery("#wmb_longitude").val();
		var wmb_zoom_level = jQuery("#wmb_zoom_level").val();
		var wmb_style_type = jQuery("#wmb_style_type").val();
		jQuery.ajax({
			type: "POST",
			url: script_url.ajax_url,
			data: ({
				action: script_action.ajax_action,
				wmb_uid : wmb_uid,
				wmb_action_status : wmb_action_status,
				wmb_map_title : wmb_map_title,
				wmb_address : wmb_address,
				wmb_iconurl : wmb_iconurl,
				wmb_latitude : wmb_latitude,
				wmb_longitude : wmb_longitude,
				wmb_zoom_level : wmb_zoom_level,
				wmb_style_type : wmb_style_type
			}),
			success: function (response_line) {
				jQuery(".spinner").css('visibility','hidden');
				jQuery("#message").show();
				jQuery("#message").addClass('error notice notice-error is-dismissible');
				jQuery("#message p").html("Map Deleted Successfully.");
				setTimeout(function(){
					window.location.reload();
				}, 5000);
			}
		});
	} 		
}
jQuery(document).ready(function() {
	jQuery('input').keypress(function(){
		jQuery(this).css("box-shadow","inset 0 0 0");
	});
	jQuery('textarea').keypress(function(){
		jQuery(this).css("box-shadow","inset 0 0 0");
	});
	jQuery('#wmb_latitude').keypress(function(event) {
	  if ((event.which != 46 && event.which != 45 || jQuery(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
	    event.preventDefault();
	  }
	});
	jQuery('#wmb_longitude').keypress(function(event) {
	  if ((event.which != 46 && event.which != 45 || jQuery(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
	    event.preventDefault();
	  }
	});
});
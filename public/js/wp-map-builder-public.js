function myMap(map_id,wmb_latitude,wmb_longitude,wmb_zoom_level,wmb_address) { 
	var myLatLng = {lat: parseFloat(wmb_latitude), lng: parseFloat(wmb_longitude)};
	console.log(myLatLng);
	var mystyler = stylers_group;
	var mapProp= {
	    center:myLatLng,
	    zoom:parseFloat(wmb_zoom_level),
		zoomControl: true,
		mapTypeControl: false,
		scaleControl: false,
		streetViewControl: false,
		rotateControl: true,
		fullscreenControl: true,
	    styles:mystyler
	};
	var image = '';

	var contentString = wmb_address;
	var infowindow = new google.maps.InfoWindow({
	   content: contentString
	});
	var map=new google.maps.Map(document.getElementById("googleMap_"+map_id),mapProp);
	var marker = new google.maps.Marker({
	    position: myLatLng,
	    map: map,
	    icon: image
	  });
	marker.addListener('click', function() {
	   infowindow.open(map, marker);
	});
}
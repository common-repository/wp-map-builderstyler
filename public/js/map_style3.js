var stylers_group = 
[
    {
        "elementType": "labels",
        "stylers": [
            {
                "visibility": "off"
            }
        ]
    },
    {
        "elementType": "geometry",
        "stylers": [
            {
                "visibility": "off"
            }
        ]
    },
    {
        "featureType": "road",
        "elementType": "geometry",
        "stylers": [
            {
                "visibility": "on"
            },
            {
                "color": "#000000"
            }
        ]
    },
    {
        "featureType": "landscape",
        "stylers": [
            {
                "color": "#ffffff"
            },
            {
                "visibility": "on"
            }
        ]
    },
    {}
];
myMap(wmb_map_style_obj.map_id,wmb_map_style_obj.wmb_latitude,wmb_map_style_obj.wmb_longitude,wmb_map_style_obj.wmb_zoom_level,wmb_map_style_obj.wmb_address);
function initialize() {
    var myLatLng = new google.maps.LatLng(-7.976965, 112.632215);
    var mapOptions = {
        zoom: 16,
        center: myLatLng,
        styles: [{featureType: "landscape", stylers: [{saturation: -100}, {lightness: 65}, {visibility: "on"}]}, {featureType: "poi", stylers: [{saturation: -100}, {lightness: 51}, {visibility: "simplified"}]}, {featureType: "road.highway", stylers: [{saturation: -100}, {visibility: "simplified"}]}, {featureType: "road.arterial", stylers: [{saturation: -100}, {lightness: 30}, {visibility: "on"}]}, {featureType: "road.local", stylers: [{saturation: -100}, {lightness: 40}, {visibility: "on"}]}, {featureType: "transit", stylers: [{saturation: -100}, {visibility: "simplified"}]}, {featureType: "administrative.province", stylers: [{visibility: "off"}]}, {featureType: "administrative.locality", stylers: [{visibility: "off"}]}, {featureType: "administrative.neighborhood", stylers: [{visibility: "on"}]}, {featureType: "water", elementType: "labels", stylers: [{visibility: "off"}, {lightness: -25}, {saturation: -100}]}, {featureType: "water", elementType: "geometry", stylers: [{hue: "#ffff00"}, {lightness: -25}, {saturation: -97}]}],
        scrollwheel: false,
        mapTypeControl: false,
        panControl: false,
        zoomControlOptions: {
            style: google.maps.ZoomControlStyle.SMALL,
            position: google.maps.ControlPosition.LEFT_BOTTOM
        }
    }
    var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);

    var image = 'images/location.png';

    var beachMarker = new google.maps.Marker({
        position: myLatLng,
        map: map,
        icon: image
    });
}

google.maps.event.addDomListener(window, 'load', initialize);
function mapInit() {
    var e = [{
        featureType: "water",
        elementType: "all",
        stylers: [{
            color: "#3b5998"
        }]
    }, {
        featureType: "administrative.province",
        elementType: "all",
        stylers: [{
            visibility: "off"
        }]
    }, {
        featureType: "all",
        elementType: "all",
        stylers: [{
            hue: "#3b5998"
        }, {
            saturation: -22
        }]
    }, {
        featureType: "landscape",
        elementType: "all",
        stylers: [{
            visibility: "on"
        }, {
            color: "#f7f7f7"
        }, {
            saturation: 10
        }, {
            lightness: 76
        }]
    }, {
        featureType: "landscape.natural",
        elementType: "all",
        stylers: [{
            color: "#f7f7f7"
        }]
    }, {
        featureType: "road.highway",
        elementType: "all",
        stylers: [{
            color: "#8b9dc3"
        }]
    }, {
        featureType: "administrative.country",
        elementType: "geometry.stroke",
        stylers: [{
            visibility: "simplified"
        }, {
            color: "#3b5998"
        }]
    }, {
        featureType: "road.highway",
        elementType: "all",
        stylers: [{
            visibility: "on"
        }, {
            color: "#8b9dc3"
        }]
    }, {
        featureType: "road.highway",
        elementType: "all",
        stylers: [{
            visibility: "simplified"
        }, {
            color: "#8b9dc3"
        }]
    }, {
        featureType: "transit.line",
        elementType: "all",
        stylers: [{
            invert_lightness: false
        }, {
            color: "#ffffff"
        }, {
            weight: .43
        }]
    }, {
        featureType: "road.highway",
        elementType: "labels.icon",
        stylers: [{
            visibility: "off"
        }]
    }, {
        featureType: "road.local",
        elementType: "geometry.fill",
        stylers: [{
            color: "#8b9dc3"
        }]
    }, {
        featureType: "administrative",
        elementType: "labels.icon",
        stylers: [{
            visibility: "on"
        }, {
            color: "#3b5998"
        }]
    }];
    [].forEach.call(document.getElementsByClassName("map-canvas"), function (elem) {
        var locations = JSON.parse(elem.dataset.mapObj);
        console.log(locations)
        var n = {
            disableDefaultUI: true,
        };
        if (typeof mapstyles === "undefined") {
            n.styles = e
        } else {
            n.styles = mapstyles
        }
        var map = new google.maps.Map(elem, n);
        //create empty LatLngBounds object
        var bounds = new google.maps.LatLngBounds();
        var infowindow = new google.maps.InfoWindow();

        for (i = 0; i < locations.length; i++) {
            var marker = new google.maps.Marker({
                position: new google.maps.LatLng(locations[i][1], locations[i][2]),
                map: map
            });

            //extend the bounds to include each markers position
            bounds.extend(marker.position);

            google.maps.event.addListener(marker, "click", (function (marker, i) {
                return function () {
                    infowindow.setContent(locations[i][0]);
                    infowindow.open(map, marker);
                }
            })(marker, i));
        }

        //now fit the map to the newly inclusive bounds
        map.fitBounds(bounds);

        //(optional) restore the zoom level after the map is done scaling
        var listener = google.maps.event.addListener(map, "idle", function () {
            map.setZoom(3);
            google.maps.event.removeListener(listener);
        });
    });
}
google.maps.event.addDomListener(window, "load", mapInit())
<?php

namespace Bolt\Extension\intendit\gmaps;

class Extension extends \Bolt\BaseExtension
{

    public function getName()
    {
        return 'gmaps';
    }

    /**
     *
     */
    function initialize()
    {
        if ($this->app['config']->getWhichEnd()=='frontend') {
            if (isset($this->config['mapstyles'])) {
                $mapstyles = $this->config['mapstyles'];
            } else {
                $mapstyles = "''";
            }
            if (isset($this->config['defaultzoom'])) {
                $defaultzoom = $this->config['defaultzoom'];
            } else {
                $defaultzoom = 1;
            }
            
            $snippet = '<script src="https://maps.googleapis.com/maps/api/js?v=3.exp"></script><script type="text/javascript" src="http://google-maps-utility-library-v3.googlecode.com/svn/trunk/markerwithlabel/src/markerwithlabel.js"></script><script>var mapstyles = '.$mapstyles.'; function mapInit(){Array.prototype.forEach.call(document.getElementsByClassName("map-canvas"),function(e){var t=JSON.parse(e.dataset.mapobj);var n={disableDefaultUI:true,styles:mapstyles,scrollwheel: false,navigationControl: false,mapTypeControl: false,scaleControl: false,draggable: false,disableDefaultUI:true};var r=new google.maps.Map(e,n);var s=new google.maps.LatLngBounds;var o=new google.maps.InfoWindow;for(i=0;i<t.length;i++){if(t[i].icon){var u=new MarkerWithLabel({labelAnchor:new google.maps.Point(8,22),icon: " ",labelContent: "<i class=\"fa fa-"+t[i].icon+" fa-2x\" style=\"color:"+t[i].color+";\"></i>",labelStyle: {color: t[i].color}, position:new google.maps.LatLng(t[i].latitude,t[i].longitude),map:r});}else{var u=new google.maps.Marker({position:new google.maps.LatLng(t[i].latitude,t[i].longitude),map:r});} s.extend(u.position);google.maps.event.addListener(u,"click",function(e,n){return function(){o.setContent("<div class=\"mapContent\">"+t[n].html+"</div>");o.open(r,e)}}(u,i))}r.fitBounds(s); window.onresize = function() { r.fitBounds(s); }; if(t.length==1){var e=google.maps.event.addListener(r,"idle",function(){r.setZoom('.$defaultzoom.');google.maps.event.removeListener(e)})}})}google.maps.event.addDomListener(window,"load",mapInit())</script>';
            
            
              $this->addTwigFunction('gmaps', 'gmapsExt');
              $this->addSnippet('endofbody', $snippet);
            }
        }
        /**
         * Twig function {{ foo("var1", "var2") }} in Namespace extension.
         */
        function gmapsExt($latitude, $longitude, $html = "", $icon = false, $color = "rgba(0,0,0,1)")
        {
            $str = "<div class='map-canvas' data-mapobj='[{\"latitude\":$latitude,\"longitude\":$longitude,\"html\": \"$html\",\"icon\":\"$icon\"}]'></div>";
            return new \Twig_Markup($str, 'UTF-8');
        }
    
}

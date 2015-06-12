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
                $defaultzoom = 14;
            }
            
<<<<<<< HEAD
            $snippet = '<script>var mapstyles = '.$mapstyles.', defaultzoom = '.$defaultzoom.';</script>';
=======
            $snippet = '<script defer="defer" src="https://maps.googleapis.com/maps/api/js?v=3.exp&callback=initializeMap"></script><script>var mapstyles = '.$mapstyles.', defaultzoom = '.$defaultzoom.';</script>';
>>>>>>> 95ad1bb00997537a4f5689eccc3892b9d8478e70
            if (!$this->app['config']->get('general/disable_script_injecting')){
                $snippet .= '<script defer="defer" src="/extensions/vendor/intendit/gmaps/assets/gmaps.js"></script>';
            }
            
              $this->addTwigFunction('gmaps', 'gmapsExt');
              $this->addSnippet('endofbody', $snippet);
            }
        }
        /**
         * Twig function {{ foo("var1", "var2") }} in Namespace extension.
         */
        function gmapsExt($latitude = "55.60806", $longitude = "13.014572", $html = "", $icon = "map-marker", $color = "rgba(0,0,0,1)")
        {
            $str = "<div class='map-canvas' data-mapobj='[{\"latitude\":$latitude,\"longitude\":$longitude,\"html\": \"$html\",\"icon\":\"$icon\"}]'></div>";
            return new \Twig_Markup($str, 'UTF-8');
        }
    
}

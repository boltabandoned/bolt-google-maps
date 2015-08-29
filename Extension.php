<?php
namespace Bolt\Extension\sahassar\googlemaps;
class Extension extends \Bolt\BaseExtension
{

    public function getName()
    {
        return 'Google Maps';
    }

    function initialize()
    {
        if ($this->app['config']->getWhichEnd()=='frontend') {
            if (!$this->app['config']->get('general/disable_script_injecting')){
                $this->addJavascript(
                    'assets/gmaps.js',
                    array('late' => true, 'priority' => 1000)
                );
                $this->addCSS('assets/gmaps.css');
            }
            $this->addTwigFunction('map', 'map', array('is_variadic' => true));
        }
    }
    function map(array $args = array())
    {
        $defaults = array(
              'latitude' => "52.08184",
              'longitude' => "4.292368",
              'html' => "",
              'icon' => "fa-map-marker",
              'color' => "rgba(0,0,0,1)",
              'map' => false,
              'maps' => false,
              'record' => false,
              'records' => false,
              'geolocation_field' => "geolocation",
              'html_field' => "body",
              'icon_field' => "icon",
              'color_field' => "color",
        );
        $args = array_merge($defaults, $args);
        $args['html'] = (string)$args['html'];
        $args = json_encode($args, true);
        $args = json_decode($args, true);
        if($args['records']){
            $map = array();
            foreach ($args['records'] as $recordItem){
                if($recordItem['values'][$args['geolocation_field']]['latitude']){
                    array_push(
                        $map,
                            array(
                                'latitude' => $recordItem['values'][$args['geolocation_field']]['latitude'],
                                'longitude' => $recordItem['values'][$args['geolocation_field']]['longitude'],
                                'html' => $recordItem['values'][$args['html_field']] ?: $recordItem['values'][$args['geolocation_field']]['formatted_address'],
                                'icon' => $recordItem['values'][$args['icon_field']] ?: $args['icon'],
                                'color' => $recordItem['values'][$args['color_field']] ?: $args['color'],
                            )
                    );
                }
            }
        }elseif($args['record']) {
            $map = array(
                array(
                    'latitude' => $args['record']['values'][$args['geolocation_field']]['latitude'],
                    'longitude' => $args['record']['values'][$args['geolocation_field']]['longitude'],
                    'html' => $args['record']['values'][$args['html_field']] ?: $args['record']['values'][$args['geolocation_field']]['formatted_address'],
                    'icon' => $args['record']['values'][$args['icon_field']] ?: $args['icon'],
                    'color' => $args['record']['values'][$args['color_field']] ?: $args['color'],
                )
            );
        }elseif($args['maps']) {
            $map = array();
            foreach ($args['maps'] as $mapItem){
                if($mapItem['latitude']){
                    array_push(
                        $map,
                        array(
                            'latitude' => $mapItem['latitude'],
                            'longitude' => $mapItem['longitude'],
                            'html' => $args['html'] ?: ($mapItem['html'] ?: $mapItem['formatted_address']),
                            'icon' => $mapItem['icon'] ?: $args['icon'],
                            'color' => $mapItem['color'] ?: $args['color'],
                        )
                    );
                }
            }
        }elseif($args['map']) {
            $map = array(
                array(
                    'latitude' => $args['map']['latitude'],
                    'longitude' => $args['map']['longitude'],
                    'html' => $args['html'] ?: $args['map']['formatted_address'],
                    'icon' => $args['icon'],
                    'color' => $args['color'],
                )
            );
        }else{
            $map = array(
                array(
                    'latitude' => $args['latitude'],
                    'longitude' => $args['longitude'],
                    'html' => $args['html'],
                    'icon' => $args['icon'],
                    'color' => $args['color'],
                )
            );
        }
        $map = json_encode($map);
        $map = str_replace("'", "\\\"", $map);
        $str = "<div class='map-canvas' data-mapobj='$map'></div>";
        return new \Twig_Markup($str, 'UTF-8');
    }
}

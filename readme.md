Google maps extension
================================

Usage:

With twig: 

{{ gmaps(record.geolocation.latitude, record.geolocation.longitude, record.title) }}

With html (for multiple markers):

<div class='map-canvas' data-mapobj='[{"latitude": 52.608489,"longitude": 11.01139,"html": "test"},{"latitude": 34.608489,"longitude": 3.01139,"html": "test2"}]'></div>

Notes:

Be sure to give ".map-canvas" a height in your css since you will otherwise not see the map.

If using foundation or other frameworks that give "img" a max-width you need to reset this for the map by giving ".map-canvas img" a max-width of "none" in your css.
Google maps extension
================================

Usage:

Single marker: 

    {{ gmaps(record.geolocation.latitude, record.geolocation.longitude, record.title) }}

Multiple markers:

    {% setcontent maps = "/pages/latest/20" %}
    <div class='map-canvas' data-mapobj='[
    {% for map in maps %}
    {"latitude":{{map.geolocation.latitude}},"longitude":{{map.geolocation.longitude}},"html": "{{map.title}}","icon":"map-marker"}
    {% if not loop.last %},{% endif %}{% endfor %}
    ]'></div>

Notes:

Be sure to give ".map-canvas" a height in your css since you will otherwise not see the map.

If using foundation or other frameworks that give "img" a max-width you need to reset this for the map by giving ".map-canvas img" a max-width of "none" in your css.

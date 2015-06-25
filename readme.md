Google maps extension
================================

Usage:

Requires font awesome to be loaded as it is used for all map icons.

In twig: 
=======
Single marker: 

    {{ gmaps(record.geolocation.latitude, record.geolocation.longitude, record.title, icon, color) }}
    
All arguments are optional, though it is reccomended that you use lognitude, latitude and title arguments.

The title argument supports HTML so you can implement all sorts of functionality there.

Multiple markers:

    {% setcontent maps = "/pages/latest/20" %}
    <div class='map-canvas' data-mapobj='[
    {% for map in maps %}
    {"latitude":{{map.geolocation.latitude}},"longitude":{{map.geolocation.longitude}},"html": "{{map.title}}","icon":"map-marker"}
    {% if not loop.last %},{% endif %}{% endfor %}
    ]'></div>

Basically it's a json array of objects with: latitude, longitude, html, icon, color.

For an example of what it looks like this in the end:

    <div class="map-canvas" data-mapobj="[
    {"latitude":59.9138688,"longitude":10.752245399999993,"html": "Beatum, inquit.","icon":"map-marker"}
    ,{"latitude":55.6760968,"longitude":12.568337100000008,"html": "Atqui reperies, inquit, in hoc quidem pertinacem;","icon":"map-marker"}
    ,{"latitude":55.604981,"longitude":13.003822000000014,"html": "Dat enim intervalla et relaxat.","icon":"map-marker"}
    ,{"latitude":59.32932349999999,"longitude":18.068580800000063,"html": "Bonum incolumis acies: misera caecitas.","icon":"map-marker"}
    ,{"latitude":60.17332440000001,"longitude":24.941024800000037,"html": "Prioris generis est docilitas, memoria;","icon":"map-marker"}
    ]"></div>

Notes:

Be sure to give ".map-canvas" a height in your css since you will otherwise not see the map.

If using foundation or other frameworks that give "img" a max-width you need to reset this for the map by giving ".map-canvas img" a max-width of "none" in your css.

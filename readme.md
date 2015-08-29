Bolt Google Maps
================================

**This is the readme for v2, if you are using v1 you want to look at [the v1 readme](readme.v1.md)**


This extension creates a twig function that takes a number of values and creates a google map via the v3 Google Maps API.

You can pass in simple values, a single geolocation object, an array of geolocation objects, a record or multiple records.

####Named values

A simple map is usually constructed with named values passed to the map() function, like this:

    {{map(
        latitude = record.geolocation.latitude,
        longitude = record.geolocation.longitude,
        html = record.body,
        icon = "fa-map-marker",
    )}}

####Single geolocation field

You can also supply it with the geolocation field directly like this:

    {{map( map = record.geolocation )}}

You can set the HTML for the infopopup via the `html` argument. The default is the `formatted_address` of the geolocation field. You can also set the map icon with the `icon` argument:

    {{map(
        map = record.geolocation
        html = record.body,
        icon = "fa-map-marker",
    )}}

####Multiple geolocation fields

Multiple geolocation fields also work, which is useful for when you build a map from multiple contenttypes:

    {% set maps = [] %}
    {% for record in records %}
        {% set maps = maps|merge([record.geolocation]) %}
    {% endfor %}
    {{map( maps = maps )}}

####Single record

You can also pass a single record, which will assume that your geolocation field is called `geolocation`, your html field is called `body`, your icon field is called `icon` and your color field is called `color`.

    {{map( record = record )}}
    
You can change where it looks for these values by following this example:

    {{map(
        record = record
        geolocation-field = "geolocation",
        html_field = "body",
        icon_field = "icon",
        color_field = "color",
    )}}
    
The values passed are the names of the fields you want to use for the respective property.

####Multiple records

Just like passing a record you can also pass multiple records to the function. Just like in the previous example you can change which fields it looks for by passing additional arguments.

    {{map( records = records )}}

And overwriting what values to use also works just like a single record:

    {{map(
        records = records
        geolocation_field = "geolocation",
        html_field = "body",
        icon_field = "icon",
        color_field = "color",
    )}}

####A couple of notes:

 - If you put the `disable_script_injecting: true` in the global config the extension will not load it's usual scripts and styles. This is useful for when you want to include them in your own scripts and styles, load them via a cdn or modify them.
 - You can change the mapstyles and the defualt zoom level by setting `window.mapstyles` and `window.defaultzoom` before this scripts execution. Becuase it's script priority is set high, all your JS should be loaded before it.
 - The extensions fontawesome only has the woff file embeded, and therefore will not be compatible with IE8-. If you want comaptability with IE8- you need to put `disable_script_injecting: true` in your main configuration and load your own fontawesome.

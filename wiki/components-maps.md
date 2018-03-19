# Google Maps

Show Google Maps in any page with simple configuration, . Not all fields in the map are necessary, just need to provide latitude longitude, elementID and keys.

> Notes: your map div ej: `#google_map` must have a width and a height, otherwise you wont see the map.

Add this where you want your map to appear:

```
<section class="my-map-wrapper container-fluid">
  <div id="google_map"></div>
</section>
```

Now add this to the blade in order to push the javascript code to the footer stack.

```
@push('scripts')
  @include('klaravel::ui.map.script', [
    'elementID' => 'google_map',
    'key' => config('myconfig.maps.google_maps_key'),
    'zoom' => config('myconfig.maps.maps_zoom'),
    'lat' => config('myconfig.maps.latitude'),
    'lng' => config('myconfig.maps.longitude'),
    'marker' => config('myconfig.maps.maps_marker_image'),
    'title' => config('myconfig.contact.name'),
    'styles' => json_encode(config('myconfig.maps.map_style'))
  ])
@endpush
```

In the example above the parameters are taken from a configuration file, an example of this configuration
file could be:

```
<?php return [
    'maps_zoom' => '12',
    'latitude' => '16.430889',
    'longitude' => '-5.166895',
    'maps_marker_image' => '/images/marker.png',
    'google_place_id' => 'ChIXXX0Rngy5A7cR7QM',
    'google_maps_key' => env('MAPS_KEY', 'XXXXXXXXXXXXXi9We0M'),
    'map_style' => [
        [
            'featureType' => 'administrative',
            'elementType' => 'labels.text.fill',
            'stylers' => [['color' => '#444444']],
        ],
        [
            'featureType' => 'landscape',
            'elementType' => 'all',
            'stylers' => [['color' => '#f2f2f2']],
        ],
        [
            'featureType' => 'poi',
            'elementType' => 'all',
            'stylers' => [['visibility' => 'off']],
        ],
        [
            'featureType' => 'road',
            'elementType' => 'all',
            'stylers' => [
                ['saturation' => -100,],
                ['lightness' => 45],
            ],
        ],
        [
            'featureType' => 'road.highway',
            'elementType' => 'all',
            'stylers' => [['visibility' => 'simplified']],
        ],
        [
            'featureType' => 'road.arterial',
            'elementType' => 'labels.icon',
            'stylers' => [[ 'visibility' => 'off']]
        ],
        [
            'featureType' => 'transit',
            'elementType' => 'all',
            'stylers' => [['visibility' => 'off']],
        ],
        [
            'featureType' => 'water',
            'elementType' => 'all',
            'stylers' =>[
                ['color' => '#ededed'],
                ['visibility' => 'on'],
            ],
        ],
    ],
];
```


The map script will place in your scripts stack a peace of code similar to this:

```
<script async defer src="https://maps.googleapis.com/maps/api/js?key=XXXXXXXXXXXXXXXXXX&callback=klaramap"></script>
<script type="text/javascript">
  function klaramap() {
    var mapOptions = {
      zoom: 14,
      scrollwheel: false,
      center: new google.maps.LatLng(16.7644486, -5.1862991),
      styles: []
    };
    var mapElement = document.getElementById('google_map');
    var map = new google.maps.Map(mapElement, mapOptions);
    var gimage = '/img/map-marker2.png';
    var marker = new google.maps.Marker({
      position: mapOptions.center,
      map: map,
      icon: gimage,
    });
  }
</script>
```

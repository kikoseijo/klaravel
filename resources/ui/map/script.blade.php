<script async defer src="https://maps.googleapis.com/maps/api/js?key={{$key or ''}}&callback=klaramap"></script>
<script type="text/javascript">
    // google.maps.event.addDomListener(window, 'load', googlemapinit);
    function klaramap() {
        var mapOptions = {
            zoom: {{$zoom or 12}},
            scrollwheel: false,
            center: new google.maps.LatLng({{ $lat }}, {{ $lng }}),
            styles: {!!$styles or '[]'!!}
        };
        var mapElement = document.getElementById('{{$elementID or 'google_map'}}');
        var map = new google.maps.Map(mapElement, mapOptions);
        var gimage = '{{$marker or '/images/marker.png'}}';
        var marker = new google.maps.Marker({
            position: mapOptions.center,
            map: map,
            icon: gimage,
            title: 'Google Map Title'
        });
    }
</script>

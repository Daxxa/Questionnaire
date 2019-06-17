@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                @include('errors')


                <br>
                {!! form($form) !!}
            </div>
        </div>
    </div>
    <div class="d"></div>
@endsection
@section('script')
    <script>
        //$('.label-class').text($('.label-class').text().substr(1, $('.label-class').text().length));
        //console.log($('.label-class').text());
        var arrayL =  $('.extra');
        for (var prop in arrayL) {
            var h = arrayL[prop].textContent;
            arrayL[prop].textContent = '';
            $(arrayL[prop]).append(h)
        }


    </script>
    <script>
        function initMap() {
            var map;
            var myLatlng = new google.maps.LatLng(-25.363882,131.044922);
            var geocoder = new google.maps.Geocoder();
            var array = document.getElementById('map');
            if (array.length > 1) {
                for (var prop in array) {
                    map = new google.maps.Map(array[prop], {
                        center: {lat: -34.397, lng: 150.644},
                        zoom: 8,
                        mapTypeId: google.maps.MapTypeId.ROADMAP
                    });

                    marker = new google.maps.Marker({
                        map: map,
                        position: {lat: -34.397, lng: 150.644},
                        draggable: true
                    });
                    google.maps.event.addListener(map, 'click', function(event) {
                        placeMarker(event.latLng, marker);
                        geo(marker, geocoder, array[prop].getAttribute('answerid'));
                    });
                }
            }else
            {
                map = new google.maps.Map(array, {
                    center: {lat: -34.397, lng: 150.644},
                    zoom: 8,
                    mapTypeId: google.maps.MapTypeId.ROADMAP
                });

                marker = new google.maps.Marker({
                    map: map,
                    position: {lat: -34.397, lng: 150.644},
                    draggable: true
                });
                google.maps.event.addListener(map, 'click', function(event) {
                    placeMarker(event.latLng, marker);
                    geo(marker, geocoder, array.getAttribute('answerid'));
                });
            }

           function geo(marker, geocoder, id) {
                geocoder.geocode({'latLng': marker.getPosition()}, function(results, status) {
                    if (status == google.maps.GeocoderStatus.OK) {
                        if (results[0]) {
                            $("label[for='"+id+"']").text(results[0].formatted_address);
                            var t =   (results[0].formatted_address);
                            $('#'+id+'.coordinate').val(marker.getPosition().lat()+', '+marker.getPosition().lng());
                        }}})};


        }
        function placeMarker(location, marker) {
            marker.setPosition(location);
        }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAmJ9rM5F57pR9UmeNDQ3tj9VoP89_bccE&callback=initMap"
            async defer></script>

    @endsection
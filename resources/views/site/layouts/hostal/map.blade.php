<link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css"
      integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="
      crossorigin=""/>
@yield('style')

<!-- Make sure you put this AFTER Leaflet's CSS -->
<script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"
        integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew=="
        crossorigin=""></script>
@yield('script')

<div class="container margin_60">
    <div class="row">
        <div class="col-md-5 col-md-offset-1 col-md-push-5">
            <figure class="room_pic left">
                <div id="mapid" class="map styled" style='width: 700px; height: 300px;margin-left:-120px;'></div>
            </figure>
        </div>
        <div class="col-md-4 col-md-offset-1 col-md-pull-6">
            <div class="information-room">

                <h3>Información </h3>
                <p>
                    {{$data['hostales'][0]['description']}}
                </p>
                <div class="row">

            </div>
        </div>
    </div><!-- End row -->
</div><!-- End container -->
</div><!-- End container -->
<script>
    var data = @json($data);
    var mymap = L.map('mapid',{
        scrollWheelZoom: false
    }).setView([23.113417, -82.413297], 13);


    L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
        maxZoom: 18,
        id: 'mapbox/streets-v11'
    }).addTo(mymap);

    L.marker([23.113417, -82.413297]).addTo(mymap);


</script>
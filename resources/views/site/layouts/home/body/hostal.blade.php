<link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css"
      integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="
      crossorigin=""/>
@yield('style')

<!-- Make sure you put this AFTER Leaflet's CSS -->
<script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"
        integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew=="
        crossorigin=""></script>
@yield('script')

<div>

    <h3>{{$item['name']}} </h3>
    <p>
        {{$item['mini_description']}}
    </p>
    <div class="row">

        <div class="tooltip_styled tooltip-effect-4">
            <div class="col-sm-1 address-icon">
                <span class="tooltip-item"><i class="icon_set_1_icon-41" style="font-size: 20px;" ></i></span>
                <div class="tooltip-content2">
                    <div class="map-tooltip" id={{$item['id']}} style='width: 300px; height: 300px;margin-left:2px;'></div>
            </div>
            </div>
                <div class="col-sm-11 address-text">
                    <h6>{{$item['address']}} </h6>
                </div>

        </div>

    </div>
    <ul>
        @foreach ($item['conforts'] as $elem)
            <li>
                <div class="tooltip_styled tooltip-effect-4">
                    <span class="tooltip-item"><i class={{$elem['icon']}}></i></span>
                    <div class="tooltip-content">
                        {{$elem['name']}}
                    </div>
                </div>
            </li>
        @endforeach

    </ul>
    <a href={{ route('hostal',['id'=>$item['id']]) }} class="btn_1_outline">{{$data['keyWorld']['read_more']}}</a>
</div>

<script>
    var hostal = @json($item);
    var mymap = L.map(String(hostal.id),{
        scrollWheelZoom: false
    }).setView([23.113417, -82.413297], 13);

    L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
        maxZoom: 18,
        id: 'mapbox/streets-v11'
    }).addTo(mymap);
    L.marker([23.113417, -82.413297]).addTo(mymap)
        .bindPopup("<b>"+hostal.name+"</b>").openPopup();


</script>

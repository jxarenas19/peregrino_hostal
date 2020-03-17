<script src="{{asset("site_assets/js/uikit.min.js")}}"></script>
@foreach ($data['hostales'][0]['rooms'] as $item)
    <div class="row">

        <div class="room_desc2 clearfix">
            <div class="col-md-7">
                <a href={{$item['images']['info'][0]['url']}} data-uk-lightbox="{group:'group1'}" title={{$item['name']}}>

                    <figure class="room_pic uk-overlay-hover">
                        <div><img src={{$item['images']['info'][0]['url']}}  alt="" class="img-responsive styled"><div class="caption"></div></div>
                        <div class="uk-overlay-panel uk-overlay-background uk-overlay-icon"></div>
                        <span class="wow zoomIn"><sup>$</sup>{{$item['priceActual']}}<small>{{$data['keyWorld']['por_noche']}}</small></span></figure>
                </a>

            </div>
            <div class="col-md-5 room_list_desc2">
                <h3 style="margin-bottom: 5px;">{{$item['name']}}</h3>
                <ul>
                    @foreach ($item['conforts'] as $elem)
                        <li>
                            <div class="tooltip_styled tooltip-effect-4">
                                <span class="tooltip-item hostal"><i class={{$elem['icon']}}></i></span>
                                <div class="tooltip-content">
                                    {{$elem['name']}}
                                </div>
                            </div>
                        </li>
                    @endforeach

                </ul>
                <div class="row" style="margin-top: -20px">
                    <!-- start pricing table -->
                <table class="table table-striped">
                        <tbody>
                        @foreach ($item['precio'] as $ok)
                            <tr>
                                <td>{{$ok['temporada']}} ({{$ok['inicio']}} to {{$ok['fin']}})</td>
                                <td><h4>${{$ok['precio']}}</h4></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div><!-- End row room -->
@endforeach
<script>
    document.getScroll = function() {
        if (window.pageYOffset != undefined) {
            return [pageXOffset, pageYOffset];
        } else {
            var sx, sy, d = document,
                r = d.documentElement,
                b = d.body;
            sx = r.scrollLeft || b.scrollLeft || 0;
            sy = r.scrollTop || b.scrollTop || 0;
            return [sx, sy];
        }
    }
    function getScroll(elem){
        if (elem.pageYOffset != undefined) {
            return [pageXOffset, pageYOffset];
        } else {
            var sx, sy, d = elem,
                r = d.documentElement,
                b = d.body;
            sx = r.scrollLeft || b.scrollLeft || 0;
            sy = r.scrollTop || b.scrollTop || 0;
            return [sx, sy];
        }
    }

</script>

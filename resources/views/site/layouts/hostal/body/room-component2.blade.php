
@foreach ($data['hostales'][0]['rooms'] as $item)
    <div class="row">

        <div class="room_desc2 clearfix" onclick="">
            <div class="col-md-7">
                <figure class="room_pic"><a href="#"><img src={{array_shift($item['images']['info'])['url']}} alt="" class="img-responsive styled"></a><span class="wow zoomIn"><sup>$</sup>{{$item['priceActual']}}<small>Per night</small></span></figure>
            </div>
            <div class="col-md-5 room_list_desc">
                <h3>{{$item['name']}}</h3>
                <h9>{{$item['tipoRoom']}}</h9>
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
                <div class="row">
                    <!-- start pricing table -->
                <table class="table table-striped">
                        <tbody>
                        @foreach ($item['precio'] as $ok)
                            <tr>
                                <td>{{$ok['temporada']}} (from {{$ok['inicio']}} to {{$ok['fin']}})</td>
                                <td><strong>${{$ok['precio']}}</strong></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div><!-- End row room -->
@endforeach

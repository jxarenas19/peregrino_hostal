
@foreach ($data['services'] as $item)
    @if($item['images']['info'])
    <div class="row">
        <div class="room_desc2 clearfix" onclick="">
            <div class="col-md-7">

                    <a href={{$item['images']['info'][0]['url']}} data-uk-lightbox="{group:'group1'}" title={{$item['name']}}>

                        <figure class="room_pic uk-overlay-hover">
                            <div><img src={{$item['images']['info'][0]['url']}}  alt="img" class="img-responsive styled"><div class="caption"></div></div>
                            <div class="uk-overlay-panel uk-overlay-background uk-overlay-icon"></div>
                            <span class="wow zoomIn"><sup>$</sup>{{$item['price']}}</span></figure>
                    </a>

            </div>
            <div class="col-md-5 room_list_desc2">
                <h6>{{$item['name']}}</h6>
                <h9>{{$item['description']}}</h9>

            </div>
        </div>
    </div><!-- End row room -->
    @endif
@endforeach

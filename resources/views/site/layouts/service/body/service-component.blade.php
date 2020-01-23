
@foreach ($data['services'] as $item)
    <div class="row">

        <div class="room_desc2 clearfix" onclick="">
            <div class="col-md-7">
                <figure class="room_pic uk-overlay-hover">
                    <a href="#">
                        <img src={{array_shift($item['images']['info'])['url']}} alt="img" class="img-responsive styled">
                    </a>
                    <div class="uk-overlay-panel uk-overlay-background uk-overlay-icon"></div>
                    <span class="wow zoomIn"><sup>$</sup>{{$item['price']}}</span></figure>
            </div>
            <div class="col-md-5 room_list_desc2">
                <h6>{{$item['name']}}</h6>
                <h9>{{$item['description']}}</h9>

            </div>
        </div>
    </div><!-- End row room -->
@endforeach

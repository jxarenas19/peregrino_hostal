<div role="tabpanel" class="tab-pane {{$status}}" id={{$id}}>
    <!-- start single room details -->
    <div class="accomodation_single_room">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 margin-bottom-30">
                            <div class="clearfix demo" style="">
                                <div class="slider">
                                    <div id="gallery_main_slider" class="carousel slide"
                                         data-ride="carousel">
                                        <div class="carousel-inner" role="listbox">
                                            @foreach ($images_hostal as $item)
                                                @if ($loop->index===0)
                                                    <div class="item active">
                                                        <div class="single_item" style="">
                                                            <img class="img-responsive styled" style="width: 100%" src={{$item['url']}} alt="">
                                                        </div>
                                                    </div>
                                                @else
                                                    <div class="item">
                                                        <div class="single_item" style="">
                                                            <img class="img-responsive styled" style="width: 100%" src={{$item['url']}} alt="">
                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>

                                        <!-- Controls -->
                                        <a class="slider_ctrl left" href="#gallery_main_slider"
                                           role="button" data-slide="prev">
                                            <i class="fa fa-angle-left"></i>
                                            <span class="sr-only">Previous</span>
                                        </a>
                                        <a class="slider_ctrl right" href="#gallery_main_slider"
                                           role="button" data-slide="next">
                                            <i class="fa fa-angle-right"></i>
                                            <span class="sr-only">Next</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @foreach ($images_room as $item)
                    <div class="col-lg-3 col-md-3 col-sm-3">
                        <div class="single_room_wrapper clearfix">
                            <div class="room_wrapper">
                                <div class="room_media">
                                    <a href={{$item['url']}}
                                        data-uk-lightbox="{group:'group1'}" title="Gallery">
                                        <figure class="uk-overlay uk-overlay-hover">
                                            <img class="img-responsive styled" alt="img" src={{$item['url']}}>
                                            <div
                                                class="uk-overlay-panel uk-overlay-background uk-overlay-icon"></div>
                                        </figure>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>

        </div>
    </div>
    <!-- end single room details -->
</div>


@foreach ($data['hostales'] as $item)
    @if ($loop->index%2===0)
        <div class="container_styled_1">
            <div class="container margin_60 ">
                <div class="row">
                    <div class="col-md-5 col-md-offset-1">
                        <figure class="room_pic"><a href="#"><img  class="img-responsive styled" src={{array_shift($item['images']['info'])['url']}} alt="" class="img-responsive"></a>
                            </figure>
                    </div>
                    <div class="col-md-4 col-md-offset-1">
                        @component('site.layouts.home.body.hostal',['item'=>$item,'data'=>$data])
                            @endcomponent
                    </div>
                </div><!-- End row -->
            </div><!-- End container -->
        </div><!-- End container_styled_1 -->
    @else
        <div class="container margin_60">
            <div class="row">
                <div class="col-md-5 col-md-offset-1 col-md-push-5">
                    <figure class="room_pic left"><a href="#"><img class="img-responsive styled" src={{array_shift($item['images']['info'])['url']}} alt="" class="img-responsive"></a>
                        </figure>
                </div>
                <div class="col-md-4 col-md-offset-1 col-md-pull-6">
                    @component('site.layouts.home.body.hostal',['item'=>$item,'data'=>$data])
                        @endcomponent
                </div>
            </div><!-- End row -->
        </div><!-- End container -->
    @endif
@endforeach

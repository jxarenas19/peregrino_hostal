
@foreach ($data['hostales'] as $item)
    @if ($loop->index%2===0)
        <div class="container_styled_1">
            <div class="container margin_60 ">
                <div class="row">
                    <div class="col-md-5 col-md-offset-1">
                        <figure class="room_pic" style="width: 100%"><a href={{ route('hostal',['id'=>$item['id']]) }}><img  class="img-responsive styled" src={{array_shift($item['images']['info'])['url']}} alt="" class="img-responsive"></a>
                            </figure>
                    </div>
                    <div class="col-md-4 col-md-offset-1">
                        <div class="room_desc_home">
                        @component('site.layouts.home.body.hostal',['item'=>$item,'data'=>$data])
                            @endcomponent
                    </div>
                    </div>
                </div><!-- End row -->
            </div><!-- End container -->
        </div><!-- End container_styled_1 -->
    @else
        <div class="container margin_60">
            <div class="row">
                <div class="col-md-5 col-md-offset-1 col-md-push-5">
                    <figure class="room_pic left"  style="width: 100%"><a href="#"><img class="img-responsive styled" src={{array_shift($item['images']['info'])['url']}} alt="" class="img-responsive"></a>
                        </figure>
                </div>
                <div class="col-md-4 col-md-offset-1 col-md-pull-6">
                    <div class="room_desc_home2">
                    @component('site.layouts.home.body.hostal',['item'=>$item,'data'=>$data])
                        @endcomponent
                </div>
                </div>
            </div><!-- End row -->
        </div><!-- End container -->
    @endif
@endforeach

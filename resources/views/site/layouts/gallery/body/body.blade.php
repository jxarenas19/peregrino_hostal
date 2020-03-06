<!-- start other detect room section -->
<div class="other_room_area">
    <div class="container">
        <div class="row">
            <div class="other_room">
                <div role="tabpanel">
                    <!-- <div class="section_title content-center"> -->

                    <!-- Nav tabs -->
                    <div class="container">
                        <div class="section_title">
                            <ul class="nav nav-tabs margin-bottom-60" role="tablist">
                                <li role="presentation" class="active"><a href="#all" aria-controls="all" role="tab"
                                                                          data-toggle="tab">all</a></li>
                                @foreach ($data['hostales'] as $item)
                                    <li role="presentation"><a
                                            href='#{{$item['id']}}' aria-controls={{$item['id']}} role="tab"
                                            data-toggle="tab">{{$item['name']}}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                    <!-- Tab panes -->
                    <div class="tab-content">
                        @component('site.layouts.gallery.body.hostal-page',['images_hostal'=>$data['images_hostal'],
                                                 'images_room'=>$data['images_room'],'id'=>'all','status'=>'active'])
                        @endcomponent
                        @foreach ($data['hostales'] as $item)
                            @component('site.layouts.gallery.body.hostal-page',['images_hostal'=>$item['images_banner']['banner'],
                                             'images_room'=>$item['images_room'],'id'=>$item['id'],'status'=>''])
                            @endcomponent
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end other detect room section -->

<!-- start Hotel Facilities section -->
<section class="hotel_facilities_area margin-top-115">
    <div class="container">
        <div class="hotel_facilities">
            <div class="section_title nice_title content-center">
                <h3>Hotel facilties</h3>
            </div>
            <div class="hotel_facilities_content">
                <div role="tabpanel">

                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        @foreach ($data["services"]["payServices"] as $item)
                            @if ($loop->index===0)
                                <li role="presentation" class="active">
                                    <a href="#first" aria-controls='first' role="tab" data-toggle="tab"><span class="tooltip-item"><i class={{$item['icon']}} style="font-size: 40px;" ></i></span></a>
                                </li>
                            @else
                                <li role="presentation" >
                                    <a href="#{{$item['id']}}" aria-controls={{$item['id']}} role="tab" data-toggle="tab"><span class="tooltip-item"><i class={{$item['icon']}} style="font-size: 40px;" ></i></span></a>
                                </li>
                            @endif
                        @endforeach
                    </ul>


                    <!-- Tab panes -->
                    <div class="tab-content">
                        @foreach ($data["services"]["payServices"] as $item)
                            @if ($loop->index==0)
                                <div role="tabpanel" class="tab-pane active" id='first'>
                                    <div class="single-tab-content">
                                        <div class="row">
                                            <div class="co-lg-5 col-md-5 col-sm-6">
                                                <div class="single-tab-image">
                                                    <a href="#"><img src={{array_shift($item['images']['info'])['url']}} alt=""></a>
                                                </div>
                                            </div>
                                            <div class="co-lg-7 col-md-7 col-sm-6">
                                                <div class="single-tab-details">
                                                    <h6>The world class</h6>
                                                    <h3>{{$item['name']}}</h3>
                                                    <p>
                                                        {{$item['description']}}
                                                    </p>
                                                    <div class="our_services">
                                                        <a href="#">service charge : ${{$item['price']}}</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div role="tabpanel" class="tab-pane" id={{$item['id']}}>
                                    <div class="single-tab-content">
                                        <div class="row">
                                            <div class="co-lg-5 col-md-5 col-sm-6">
                                                <div class="single-tab-image">
                                                    <a href="#"><img  src={{array_shift($item['images']['info'])['url']}} alt=""></a>
                                                </div>
                                            </div>
                                            <div class="co-lg-7 col-md-7 col-sm-6">
                                                <div class="single-tab-details">
                                                    <h6>The world class</h6>
                                                    <h3>{{$item['name']}}</h3>
                                                    <p>
                                                        {{$item['description']}}
                                                    </p>
                                                    <div class="our_services">
                                                        <a href="#">service charge : ${{$item['price']}}</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach


                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
<!-- end Hotel Facilities section -->
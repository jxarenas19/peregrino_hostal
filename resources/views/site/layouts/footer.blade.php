<!-- start footer -->
<footer class="footer_area">
    <div class="footer">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="footer_widget">
                    <div class="footer_map">
                        <a href="#"><img src="{{URL::asset('site_assets/img/otherstyle2.png')}}" alt=""></a>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-3" style="padding-top: 60px;">
                <div class="footer_widget">
                    <h2 style="color: #fff;">Puedes encontrarnos en:</h2>
                    <ul>
                        <li>
                            @foreach ($data['hostales'] as $item)
                                <P><i class="fa fa-map-marker"></i>{{$item['address']}}</P>
                            @endforeach
                        </li>
                    </ul>

                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-3" style="padding-top: 60px;">
                <div class="row">
                    <div class="footer_widget clearfix">
                        <h2 class="padding-left-10" style="color: #fff;">Accede a:</h2>
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <ul>
                                <li><a href={{ route('service') }}>{{$data['keyWorld']['servicios_agregados']}}</a></li>
                                <li><a href={{ route('booking') }}>{{$data['keyWorld']['booking']}}</a></li>
                                <li><a href={{ route('gallery') }}>{{$data['keyWorld']['galeria']}}</a></li>
                            </ul>
                        </div>
                        <div class="col-lg-6 col-md-6 sol-sm-6">
                            <ul>
                                @foreach ($data['hostales'] as $item)

                                    <li><a href={{ route('hostal',['id'=>$item['id']]) }}>{{$item['name']}}</a></li>
                                @endforeach

                            </ul>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="row">
            <div class="container">
                <div id="social_footer">
                    <ul>
                        @foreach ($data['sociales'] as $item)
                            <li><a href="#"><i class={{$item['icon']}}></i></a></li>
                        @endforeach
                    </ul>
                </div>
                <div class="footer_copyright content-center">
                    <p>© {{ date('Y') }} <a href="#">Hostalperegrino</a>. All rights reserved</p>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- end footer -->

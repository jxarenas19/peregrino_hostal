<!-- start footer -->
<footer class="footer_area">
    <div class="container">
        <div class="footer">
            <div class="footer_top padding-top-80 clearfix">
                <div class="col-lg-4 col-md-4 col-sm-4">
                    <div class="footer_widget">
                        <h5 class="padding-left-15">Datos Generales</h5>
                        <p>Puedes encontrarnos en:</p>
                        <ul>
                            <li>
                                <P><i class="fa fa-map-marker"></i>St Amsterdam finland, <br> United Stats of AKY16 8PN</P>
                                <P><i class="fa fa-map-marker"></i>St Amsterdam finland, <br> United Stats of AKY16 8PN</P>
                            </li>
                        </ul>

                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4">
                    <div class="row">
                        <div class="footer_widget clearfix">
                            <h5 class="padding-left-15">Quick Links</h5>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <ul>
                                    <li><a href={{ route('service') }}>{{$data['keyWorld']['servicios_agregados']}}</a></li>
                                    <li><a href={{ route('booking') }}>{{$data['keyWorld']['booking']}}</a></li>
                                    <li><a href="#">{{$data['keyWorld']['galeria']}}</a></li>
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
                <div class="col-lg-4 col-md-4 col-sm-4">
                    <div class="footer_widget">
                        <h5>We Are Global</h5>
                        <div class="footer_map">
                            <a href="#"><img src="{{URL::asset('site_assets/img/footer-map-two.jpg')}}" alt=""></a>
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
                    <div class="footer_copyright margin-tb-50 content-center">
                        <p>© {{ date('Y') }} <a href="#">Hostalperegrino</a>. All rights reserved</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- end footer -->
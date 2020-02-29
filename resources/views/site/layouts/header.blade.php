<!-- start preloader -->


<div id="loader-wrapper">
    <div class="logo"><a href="#"><span>Hostal</span>-Peregrino</a></div>
    <div id="loader">
    </div>
</div>
<!-- end preloader -->

<!-- start header -->
<header class="header_area">

    <!-- start main header -->
    <div class="main_header_area">
        <div class="container header-barra">
            <!-- start mainmenu & logo -->
            <div class="mainmenu">
                <div id="nav">
                    <nav class="navbar navbar-default">
                        <!-- Brand and toggle get grouped for better mobile display -->
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                            <div class="site_logo fix">
                                <a id="brand" class="clearfix navbar-brand border-right-whitesmoke" href="#"><img src="{{URL::asset('site_assets/img/site-logo.png')}}" alt="Trips"></a>
                            </div>
                        </div>

                        <!-- Collect the nav links, forms, and other content for toggling -->
                        <div class="collapse navbar-collapse navbar-right" id="bs-example-navbar-collapse-1">
                            <ul class="nav navbar-nav">
                                <li><a href={{ route('inicio') }}>{{$data['keyWorld']['inicio']}}</a></li>
                                <li role="presentation" class="dropdown">
                                    <a id="drop-one" href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" role="button" aria-expanded="false">
                                        {{$data['keyWorld']['hostales']}}
                                    </a>
                                    <ul class="dropdown-menu" role="menu">
                                    @foreach ($data['hostales'] as $item)

                                        <li role="presentation"><a role="menuitem" tabindex="-1" href={{ route('hostal',['id'=>$item['id']]) }}>{{$item['name']}}</a></li>
                                    @endforeach
                                    </ul>

                                </li>
                                <li><a href={{ route('service') }}>{{$data['keyWorld']['servicios_agregados']}}</a></li>
                                <li><a href={{ route('booking') }}>{{$data['keyWorld']['booking']}}</a></li>
                                <li><a href="#">{{$data['keyWorld']['galeria']}}</a></li>
                                <ul id="lang_top">
                                    @foreach ($data['languages'] as $item)
                                        @if ($item['code'] == $data['language_active'])
                                            <li><a href="lang/{{$item['code']}}" class="active">{{$item['code']}}</a></li>
                                        @else
                                            <li><a href="lang/{{$item['code']}}" >{{$item['code']}}</a></li>
                                        @endif
                                    @endforeach
                                </ul>

                            </ul>
                            <div class="emergency_number">
                                <a href="tel:1234567890"><img src="img/call-icon.png" alt="">+53 7 8601257 / +53 7 8618027</a>
                            </div>
                        </div><!-- /.navbar-collapse -->
                    </nav>
                </div>
            </div>
            <!-- end mainmenu and logo -->
        </div>
    </div>
    <!-- end main header -->

</header>
<!-- end header -->

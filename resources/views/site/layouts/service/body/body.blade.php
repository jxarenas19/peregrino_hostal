@section('styles')
    <link rel="stylesheet" href="{{asset("site_assets/css/body.css")}}">
@stop


<script src="{{asset("site_assets/js/vendor/jquery-1.11.2.min.js")}}"></script>
<script src="{{asset("personalmodal/js/prism.js")}}"></script>
<script src="{{asset("personalmodal/js/bootstrap-show-modal.js")}}"></script>
<script src="{{asset("site_assets/js/theia-sticky-sidebar.js")}}"></script>
<script src="{{asset("site_assets/js/wow.min.js")}}"></script>

<div class="container">
    <div class="row">
        <div class="col-lg-9 col-md-8">
            @include('site.layouts.service.body.service-component')

        </div>
        <div class="col-lg-3 col-md-4 sidebar">

            <div class="theiaStickySidebar">
                <div class="box_style_3" id="general_facilities">
                    <div class="hotel_booking_area clearfix">
                        <div class="hotel_booking3">
                            <form id="form1" role="form" action="#" class="">
                                <div class="col-lg-12 col-md-12">
                                    <div class="room_book">
                                        <h6>{{$data['keyWorld']['select_your_room']}}</h6>
                                        <p>{{$data['keyWorld']['servicio']}}</p>
                                    </div>
                                </div>
                                <div class="form-group col-lg-12 col-md-12">
                                    <div class="input-group border-bottom-dark-2">
                                        <input class="date-picker" id="datepicker"
                                               placeholder={{$data['keyWorld']['llegada']}} type="text"/>
                                        <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                                <div class="form-group col-lg-12 col-md-12">
                                    <div class="input-group border-bottom-dark-2">
                                        <input class="date-picker" id="datepicker1"
                                               placeholder={{$data['keyWorld']['salida']}} type="text"/>
                                        <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12">
                                    <div class="row">

                                        <div class="form-group col-lg-12 col-md-12">
                                            <div class="input-group border-bottom-dark-2">
                                                <input id="inputguest"
                                                       placeholder={{$data['keyWorld']['cant_personal_field']}} type="text"/>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12">
                                    <a class="btn btn-warning btn-md floatright">Book</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div><!-- End row -->
</div><!-- End container -->

<form id="formGeneral2" hidden>
    <div id="addField2">

    </div>

</form>
<script>
    jQuery('.sidebar').theiaStickySidebar({
        additionalMarginTop: 120
    });

</script>
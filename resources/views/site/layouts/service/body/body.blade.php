@section('styles')
    <link rel="stylesheet" href="{{asset("site_assets/css/body.css")}}">
@stop


<script src="{{asset("site_assets/js/vendor/jquery-1.11.2.min.js")}}"></script>
<script src="{{asset("personalmodal/js/prism.js")}}"></script>
<script src="{{asset("personalmodal/js/bootstrap-show-modal.js")}}"></script>
<script src="{{asset("site_assets/js/theia-sticky-sidebar.js")}}"></script>
<script src="{{asset("site_assets/js/wow.min.js")}}"></script>
<script src="{{asset("site_assets/js/moment.min.js")}}"></script>
<script src="{{asset("site_assets/js/lightpick.js")}}"></script>

<div class="container">
    <div class="row">
        <div class="col-lg-8 col-md-7">
            @include('site.layouts.service.body.service-component')

        </div>
        <div class="col-lg-4 col-md-5 sidebar">

            <div class="theiaStickySidebar">
                <div class="box_style_3" id="general_facilities">
                    <div class="hotel_booking_area clearfix">
                        <div class="hotel_booking3">
                            <form id="form1" role="form" action="#" class="">
                                <div class="col-lg-12 col-md-12">
                                    <div class="room_book">

                                        <p>Carrusel</p>
                                    </div>
                                </div>

                                <div class="form-group col-lg-12 col-md-12">
                                    <div class="table-responsive" style="padding-top: 10%;">
                                        <table class="table table-bordered">
                                            <tr class="room_table">
                                                <td class="col-lg-8 col-md-9"><span style="font-size: 14px;" class="imp_table_text">Servicio</span></td>

                                                <td class="col-lg-2 col-md-2"><span style="font-size: 14px;" class="imp_table_text">Precio</span></td>
                                                <td class="col-lg-2 col-md-1"><span class="imp_table_text"></span></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12">
                                    <a id="bookingServiceButton" href={{route('bookingService')}} class="btn btn-warning btn-md floatright">Book</a>
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
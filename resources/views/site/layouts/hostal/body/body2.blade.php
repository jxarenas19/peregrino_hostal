@section('styles')
    <link rel="stylesheet" href="{{asset("site_assets/css/body.css")}}">
@stop


    <script src="{{asset("site_assets/js/vendor/jquery-1.11.2.min.js")}}"></script>
    <script src="{{asset("site_assets/js/moment.min.js")}}"></script>
    <script src="{{asset("site_assets/js/lightpick.js")}}"></script>
    <script src="{{asset("personalmodal/js/prism.js")}}"></script>
    <script src="{{asset("personalmodal/js/bootstrap-show-modal.js")}}"></script>
    <script src="{{asset("site_assets/js/theia-sticky-sidebar.js")}}"></script>
    <script src="{{asset("site_assets/js/wow.min.js")}}"></script>
    <script type="text/javascript">var hostales = @json($data['hostales']);var dataBooking = null;</script>
    <script src="{{asset("personalmodal/js/modal_functions.js")}}"></script>


<div class="section_title nice_title content-center">
    <h3>{{$data['hostales'][0]['name']}}</h3>
</div>
<div class="container">
    <div class="row">
        <div class="col-lg-8 col-md-7">
            @include('site.layouts.hostal.body.room-component2')

        </div>
        <div class="col-lg-4 col-md-5 sidebar">

            <div class="theiaStickySidebar">
                <div class="box_style_3" id="general_facilities">
                    <div class="hotel_booking_area clearfix">
                        <div class="hotel_booking3">
                            <form id="form1" role="form" action="#" class="">
                                <div class="col-lg-12 col-md-12">
                                    <div class="room_book">
                                        <h6>{{$data['keyWorld']['select_your_room'].' '.$data['keyWorld']['rooms']}} </h6>
                                    </div>
                                </div>
                                <div class="form-group col-lg-12 col-md-12">
                                    <div class="input-group border-bottom-dark-2">
                                        <input placeholder={{$data['keyWorld']['llegada']}} type="text" id="datepicker" class="form-control form-control-sm"/>
                                        <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                                <div class="form-group col-lg-12 col-md-12">
                                    <div class="input-group border-bottom-dark-2">
                                        <input placeholder={{$data['keyWorld']['salida']}} type="text" id="datepicker1" class="form-control form-control-sm"/>
                                        <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12">
                                    <div class="row">
                                        <div class="form-group col-lg-12 col-md-12 icon_arrow">
                                            <div class="input-group border-bottom-dark-2">
                                                <select onchange="selectHostal(this)"
                                                        class="form-control" name="hostal"
                                                        id="room">
                                                    <option data-hostal=0 value={{$data['hostales'][0]['id']}} selected="selected"
                                                            disabled="disabled">{{$data['hostales'][0]['name']}}</option>


                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group col-lg-12 col-md-12">
                                            <div class="input-group border-bottom-dark-2">
                                                <input id="button-form"
                                                       placeholder={{$data['keyWorld']['cant_personal_field']}} type="text"/>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12">
                                    <a class="btn btn-warning btn-md floatright" id="bookingButton" href={{route('booking')}}>{{$data['keyWorld']['reserva']}}</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div><!-- End row -->
</div><!-- End container -->

<form id="formGeneral" hidden>
    <div id="addField">

    </div>

</form>

<script>
    jQuery('.sidebar').theiaStickySidebar({
        additionalMarginTop: 120
    });

</script>
<script>
    new Lightpick({
        field: document.getElementById('datepicker'),
        secondField: document.getElementById('datepicker1') ,
        minDate: new Date(),
    });

</script>

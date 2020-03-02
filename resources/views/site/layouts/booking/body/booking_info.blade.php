@section('styles')
    <link rel="stylesheet" href="{{asset("site_assets/css/body.css")}}">
@stop
<div role="tabpanel" class="tab-pane active " id="booking_info">
    <div class="booking_info_area">
        <div class="facilities_name clearfix margin-bottom-150 margin-top-70">
            <div class="row">
                @include('site.layouts.booking.body.register-booking')
            </div>
            <div class="container">
                <div id="addRoomBooking" class="row">

                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="booking_next_btn padding-top-30 margin-top-20 clearfix border-top-whitesmoke">
                        <a href="#" id="infoButton" disabled='disabled' onclick="goToService()" class="btn btn-warning btn-sm floatright">{{$data['keyWorld']['next']}}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<script>

    function goToService() {
        var tabService = $('#myTab a[href="#service_info"]');
        tabService.removeClass('isDisabled');

        tabService.tab('show');
    }
</script>

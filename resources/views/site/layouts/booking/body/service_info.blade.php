@section('styles')
    <link rel="stylesheet" href="{{asset("site_assets/css/body.css")}}">
@stop
<div role="tabpanel" class="tab-pane" id="service_info">
    <div class="booking_info_area">
        <div class="facilities_name clearfix margin-bottom-150 margin-top-70">
        <div id="addServiceBooking">
            <div class="row">

                @foreach ($data['services']['payServices'] as $item)
                    @component('site.layouts.bookingService.body.service-item',[
                        'item'=>$item,'data'=>$data,
                        'iconDate'=>"icon-calendar-empty only-icon",
                        'services'=>$data['services']['payServices'],
                        'selected'=>false,'index'=>$loop->index,'dataReserva'=>collect()])
                    @endcomponent
                @endforeach

            </div>
        </div>
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="booking_next_btn padding-top-30 margin-top-20 clearfix border-top-whitesmoke">
                        <a href="#" onclick="goToBack('booking_info')" class="btn btn-warning btn-sm btn-info">{{$data['keyWorld']['back']}}</a>
                        <a href="#" id="infoButton" onclick="goToPersonal()" class="btn btn-warning btn-sm floatright">{{$data['keyWorld']['next']}}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<script>
    function goToPersonal() {
        var tabPersonal = $('#myTab a[href="#personal_info"]');
        tabPersonal.removeClass('isDisabled');

        tabPersonal.tab('show');
    }
    function goToBack(tab){
        tabBack = $('#myTab a[href="#'+tab+'"]');
        tabBack.tab('show');
    }

</script>

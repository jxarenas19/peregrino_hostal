@section('styles')
    <link rel="stylesheet" href="{{asset("site_assets/css/body.css")}}">
@stop
<script src="{{asset("site_assets/js/vendor/jquery-1.11.2.min.js")}}"></script>
<script src="{{asset("site_assets/js/moment.min.js")}}"></script>
<script src="{{asset("site_assets/js/lightpick.js")}}"></script>
<script src="{{asset("personalmodal/js/prism.js")}}"></script>
<div role="tabpanel" class="tab-pane active" id="service_info">
    <div class="booking_info_area">
        <div class="facilities_name clearfix margin-bottom-150 margin-top-70">
        <div id="addServiceBooking">
            <div class="row">

                @foreach ($data['services']['payServices'] as $item)

                    @if(in_array(strval($item['id']),collect($data['data'])->keys()->toArray()))
                        @component('site.layouts.bookingService.body.service-item',[
                        'item'=>$item,
                        'data'=>$data,
                        'selected'=>true,
                        'services'=>$data['services']['payServices'],
                        'index'=>$loop->index,
                        'iconDate'=>"icon-calendar only-icon",
                        'dataReserva'=>collect($data['data'])[$item['id']]])
                        @endcomponent
                    @else
                        @component('site.layouts.bookingService.body.service-item',[
                        'item'=>$item,'data'=>$data,
                        'iconDate'=>"icon-calendar-empty only-icon",
                        'services'=>$data['services']['payServices'],
                        'selected'=>false,'index'=>$loop->index,'dataReserva'=>collect()])
                        @endcomponent
                    @endif
                @endforeach

            </div>
        </div>
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="booking_next_btn clearfix border-top-whitesmoke">
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

@section('styles')
    <link rel="stylesheet" href="{{asset("site_assets/css/body.css")}}">
@stop
<div role="tabpanel" class="tab-pane" id="service_info">
    <div class="booking_info_area">
        <div class="facilities_name clearfix margin-bottom-150 margin-top-70">
        <div id="addServiceBooking">
            <div class="row">

                @foreach ($data['services']['payServices'] as $item)
                    @component('site.layouts.booking.body.service-item',['item'=>$item,'data'=>$data])
                    @endcomponent
                @endforeach

            </div>
        </div>
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="booking_next_btn padding-top-30 margin-top-20 clearfix border-top-whitesmoke">
                        <a href="#" id="infoButton" disabled='disabled' onclick="nextTab()" class="btn btn-warning btn-sm floatright">Next</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<script>

    function nextTab() {
        $('#myTab a[href="#service_info"]').tab('show');
    }
</script>
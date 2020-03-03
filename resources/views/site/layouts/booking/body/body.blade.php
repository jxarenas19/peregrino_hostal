<section class="booking_area">
    <div class="container">
        <div class="booking">
            <div role="tabpanel">
                <!-- Nav tabs -->
                <ul id="myTab" class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active">
                        <a href="#booking_info" aria-controls="booking_info" role="tab" data-toggle="tab"><i>1</i><span>booking info</span></a>
                    </li>
                    <li role="presentation">
                        <a class="isDisabled" href="#service_info" aria-controls="service_info" role="tab" data-toggle="tab"><i>2</i><span>{{$data['keyWorld']['servicios_agregados']}}</span></a>
                    </li>
                    <li role="presentation">
                        <a class="isDisabled" href="#personal_info" aria-controls="personal_info" role="tab" data-toggle="tab"><i>3</i><span>{{$data['keyWorld']['datos_personales']}}</span></a>
                    </li>
                    <li role="presentation">
                        <a class="isDisabled" href="#booking_done" aria-controls="booking_done" role="tab" data-toggle="tab"><i>4</i><span>booking done</span></a>
                    </li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    @include('site.layouts.booking.body.booking_info')
                    @include('site.layouts.booking.body.service_info')
                    @include('site.layouts.booking.body.personal_info')
                    @include('site.layouts.booking.body.finish_info')



                </div>

            </div>

        </div>
    </div>
</section>

<script>
    var bookingJson = {
        'generalBookingData':{},
        'bookingRoom':[],
        'bookingService':[],
        'generalData':{}
    }
    var dataServices = {}
</script>

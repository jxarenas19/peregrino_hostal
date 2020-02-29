<section class="booking_area">
    <div class="container">
        <div class="booking">
            <div role="tabpanel">
                <!-- Nav tabs -->
                <ul id="myTab" class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active">
                        <a href="#service_info" aria-controls="service_info" role="tab" data-toggle="tab"><i>2</i><span>{{$data['keyWorld']['servicios_agregados']}}</span></a>
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
                    @include('site.layouts.bookingService.body.service_info')
                    @include('site.layouts.bookingService.body.personal_info')


                    <div role="tabpanel" class="tab-pane" id="booking_done">
                        <div class="booking_done_area margin-top-65 margin-bottom-70">
                            <div class="row">
                                <div class="col-lg-7 col-md-7 col-sm-6">
                                    <div class="booking_done_info">
                                        <p>
                                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Optio quas excepturi reprehenderit odit, accusantium, laborum natus est cumque molestias ex rem dolores harum, exercitationem quisquam tenetur qui non libero architecto.
                                        </p>
                                        <form role="form">
                                            <div class="checkbox booking_done_confirmation">
                                                <a href="#"> <i class="fa fa-check-circle"></i> Your reservation was succefully submited!! </a>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="col-lg-5 col-md-5 col-sm-6">
                                    <div class="room_cost">
                                        <div class="table-responsive">
                                            <table class="table table-bordered">
                                                <tr class="room_table">
                                                    <td class=""><span class="imp_table_text">1 Room</span> <br>Two Adult & 1 child</td>
                                                    <td class=""><span class="imp_table_text">180$</span> <br> rate</td>
                                                    <td class="">5 <br>night</td>
                                                    <td class=""><span class="imp_table_text">400$</span></td>
                                                </tr>
                                                <tr class="total_table">
                                                    <td class=""><span class="imp_table_text">total</span></td>
                                                    <td class="" colspan="3"><span class="imp_table_text">440$</span> <br> <span class="total_pain_info">(paid)</span></td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</section>


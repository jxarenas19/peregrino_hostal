<section class="booking_area">
    <div class="container">
        <div class="booking">
            <div role="tabpanel">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active">
                        <a href="#booking_info" aria-controls="booking_info" role="tab" data-toggle="tab"><i>1</i><span>booking info</span></a>
                    </li>
                    <li role="presentation">
                        <a href="#personal_info" aria-controls="personal_info" role="tab" data-toggle="tab"><i>2</i><span>personal info</span></a>
                    </li>
                    <li role="presentation">
                        <a href="#payment_info" aria-controls="payment_info" role="tab" data-toggle="tab"><i>3</i><span>payment info</span></a>
                    </li>
                    <li role="presentation">
                        <a href="#booking_done" aria-controls="booking_done" role="tab" data-toggle="tab"><i>4</i><span>booking done</span></a>
                    </li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    @include('site.layouts.booking.body.booking_info')
                    @include('site.layouts.booking.body.personal_info')

                    <div role="tabpanel" class="tab-pane" id="payment_info">
                        <div class="payment_info_area">
                            <div class="hotel_booking_area">
                                <div class="hotel_booking4 margin-top-70 margin-bottom-125">
                                    <form role="form" action="#" class="">
                                        <div class="row">
                                            <div class="container">
                                                <div class="payment_info_details margin-bottom-50">
                                                    <p>
                                                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nihil atque modi velit molestiae, repellendus iure sint possimus cumque, provident, dolorum unde laboriosam ut eius ex maiores quod repudiandae aut asperiores?
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-lg-3 col-md-3 col-sm-3 icon_arrow">
                                                <div class="input-group">
                                                    <input type="text" class="form-control" placeholder="Card Holder Name">
                                                </div>
                                            </div>
                                            <div class="form-group col-lg-3 col-md-3 col-sm-3 icon_arrow">
                                                <div class="input-group">
                                                    <input type="text" class="form-control" placeholder="Enter Creadit Card Number">
                                                </div>
                                            </div>
                                            <div class="form-group col-lg-3 col-md-3 col-sm-3 icon_arrow">
                                                <div class="input-group">
                                                    <select class="form-control" name="room" id="enter_month">
                                                        <option selected="selected" disabled="disabled">Enter Month</option>
                                                        <option value="Single">Enter Month</option>
                                                        <option value="Double">Enter Month</option>
                                                        <option value="Deluxe">Enter Month</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group col-lg-3 col-md-3 col-sm-3 icon_arrow">
                                                <div class="input-group">
                                                    <select class="form-control" name="room" id="enter_year">
                                                        <option selected="selected" disabled="disabled">Enter Year</option>
                                                        <option value="Single">Enter Year</option>
                                                        <option value="Double">Enter Year</option>
                                                        <option value="Deluxe">Enter Year</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="container">
                                                <div class="payment_system clearfix">
                                                    <div class="left_payment_system clearfix floatleft">
                                                        <ul class="clearul">
                                                            <li><a href="#"><img src="img/american-express.png" alt=""></a></li>
                                                            <li><a href="#"><img src="img/discover.png" alt=""></a></li>
                                                            <li><a href="#"><img src="img/paypal.png" alt=""></a></li>
                                                            <li><a href="#"><img src="img/visa.png" alt=""></a></li>
                                                            <li><a href="#"><img src="img/maestro.png" alt=""></a></li>
                                                        </ul>
                                                    </div>
                                                    <div class="right_pay_now floatright">
                                                        <a href="#" class="btn btn-warning btn-sm btn-success">Pay Now</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12">
                                                <div class="booking_next_btn padding-top-30 margin-top-40 clearfix border-top-whitesmoke">
                                                    <a href="#" class="btn btn-warning btn-sm btn-info">back</a>
                                                    <a href="#" class="btn btn-warning btn-sm floatright">Next</a>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
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
                                                <tr class="tax_table">
                                                    <td class=""><span class="imp_table_text">tax</span> <br> 10% on booking value</td>
                                                    <td class="" colspan="3"><span class="imp_table_text">40$</span></td>
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

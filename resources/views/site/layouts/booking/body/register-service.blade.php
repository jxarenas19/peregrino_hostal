<script src="{{asset("personalmodal/js/jquery.min.js")}}"></script>
<script src="{{asset("personalmodal/js/prism.js")}}"></script>
<script src="{{asset("personalmodal/js/bootstrap-show-modal.js")}}"></script>

<div class="hotel_booking_area">
    <div class="container">
        <div class="hotel_booking5">
            <form id="form1" role="form" action="#" class="">
                <div class="col-lg-2 col-md-2 col-sm-2">
                    <div class="room_book border-right-dark-1">
                        <h6>{{$data['keyWorld']['select_your_room']}}</h6>
                        <p>Service</p>
                    </div>
                </div>
                <div class="form-group col-lg-2 col-md-2 col-sm-2">
                    <div class="input-group border-bottom-dark-2">
                        <input class="date-picker" id="datepicker"
                               placeholder={{$data['keyWorld']['llegada']}} type="text"/>
                        <div class="input-group-addon"><i
                                    class="fa fa-calendar"></i></div>
                    </div>
                </div>
                <div class="form-group col-lg-2 col-md-2 col-sm-2">
                    <div class="input-group border-bottom-dark-2">
                        <input class="date-picker" id="datepicker1"
                               placeholder={{$data['keyWorld']['salida']}} type="text"/>
                        <div class="input-group-addon"><i
                                    class="fa fa-calendar"></i></div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<form id="formGeneral" hidden>
    <div id="addField">

    </div>

</form>

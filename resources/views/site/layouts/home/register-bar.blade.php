<script src="{{asset("personalmodal/js/jquery.min.js")}}"></script>
<script src="{{asset("personalmodal/js/prism.js")}}"></script>
<script src="{{asset("personalmodal/js/bootstrap-show-modal.js")}}"></script>
<script src="{{asset("site_assets/js/moment.min.js")}}"></script>
<script src="{{asset("site_assets/js/lightpick.js")}}"></script>


<script type="text/javascript">var hostales = @json($data['hostales']); var dataBooking=null;</script>
<script src="{{asset("personalmodal/js/modal_functions.js")}}"></script>

<div class="hotel_booking_area">
    <div class="container">
        <div class="hotel_booking">
            <form id="form1" role="form" action="#" class="">
                <div class="col-lg-2 col-md-2 col-sm-2">
                    <div class="room_book border-right-dark-1">
                        <h6>{{$data['keyWorld']['select_your_room']}}</h6>
                        <h6>{{$data['keyWorld']['rooms']}}</h6>
                    </div>
                </div>
                <div class="form-group col-lg-2 col-md-2 col-sm-2">
                    <div class="input-group border-bottom-dark-2">
                        <input placeholder={{$data['keyWorld']['llegada']}} type="text" id="datepicker" class="form-control form-control-sm"/>
                        <div class="input-group-addon"><i
                                    class="fa fa-calendar"></i></div>
                    </div>
                </div>

                <div class="form-group col-lg-2 col-md-2 col-sm-2">
                    <div class="input-group border-bottom-dark-2">
                        <input placeholder={{$data['keyWorld']['salida']}} type="text" id="datepicker1" class="form-control form-control-sm"/>
                        <div class="input-group-addon"><i
                                    class="fa fa-calendar"></i></div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="row">
                        <div class="form-group col-lg-7 col-md-7 col-sm-7 icon_arrow">
                            <div class="input-group border-bottom-dark-2">
                                <select onchange="selectHostal(this)"
                                        class="form-control" name="hostal"
                                        id="room">
                                    <option selected="selected"
                                            disabled="disabled">{{$data['keyWorld']['select_hostal']}}</option>
                                    @foreach ($data['hostales'] as $item)
                                        <option data-hostal={{$loop->index}} value={{$item['id']}}>{{$item['name']}}</option>
                                    @endforeach

                                </select>
                            </div>
                        </div>
                        <div class="form-group col-lg-4 col-md-4 col-sm-4">
                            <div class="input-group border-bottom-dark-2">
                                <input id="button-form"
                                       placeholder={{$data['keyWorld']['cant_personal_field']}} type="text"/>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                     <a type="button" class="btn btn-primary floatright">Reservar</a>
                 </div>-->
            </form>
            <!-- end offer start -->
        </div>
    </div>
</div>

<form id="formGeneral" hidden>
    <div id="addField">

    </div>

</form>

<script>
    new Lightpick({
        field: document.getElementById('datepicker'),
        secondField: document.getElementById('datepicker1') ,
        minDate: new Date(),
    });
    var bookingJson = {
        'generalBookingData':{},
        'bookingRoom':[],
        'bookingService':[],
        'generalData':{}
    }
</script>
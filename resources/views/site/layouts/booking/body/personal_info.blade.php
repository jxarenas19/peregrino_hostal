<div role="tabpanel" class="tab-pane" id="personal_info">
    <div class="personal_info_area">
        <div class="hotel_booking4 margin-top-70 margin-bottom-125">
            <form role="form" action="#" class="">
                <div class="row">
                    <div class="form-group col-lg-4 col-md-4 col-sm-4 icon_arrow">
                        <div class="input-group">
                            <input type="text" onchange="nombreChange(this)" class="form-control" placeholder={{$data['keyWorld']['persona_name']}}>
                        </div>
                    </div>
                    <div class="form-group col-lg-4 col-md-4 col-sm-4 icon_arrow">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder={{$data['keyWorld']['nacionality']}}>
                        </div>
                    </div>
                    <div class="form-group col-lg-4 col-md-4 col-sm-4 icon_arrow">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder={{$data['keyWorld']['email']}}>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-lg-6 col-md-6 col-sm-6 icon_arrow">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder={{$data['keyWorld']['flight_number']}}>
                        </div>
                    </div>
                    <div class="form-group col-lg-6 col-md-6 col-sm-6 icon_arrow">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder={{$data['keyWorld']['arrived_hour']}}>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="container">
                        <div class="form-group">
                            <textarea class="form-control" rows="5" id="comment" placeholder="Any Specific request"></textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="booking_next_btn padding-top-30 margin-top-50 clearfix border-top-whitesmoke">
                            <a href="#" onclick="goToBack('service_info')" class="btn btn-warning btn-sm btn-info">back</a>
                            <a href="#" onclick="goToFinish()" class="btn btn-warning btn-sm floatright">Next</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    function goToFinish() {
        var tabDone = $('#myTab a[href="#booking_done"]');
        tabDone.removeClass('isDisabled');

        tabDone.tab('show');
        bookingJson.generalData = {
            'nombre': 'nombre',
            'nacionalidad':'nacion',
            'mail':'correo',
            'aerolinea':'avion',
            'hora':'09:00',
            'others':'muela'
        }
    }
    function nombreChange(elem) {
        console.log(elem)
    }

</script>
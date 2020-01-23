@section('styles')
    <link rel="stylesheet" href="{{asset("site_assets/css/body.css")}}">
@stop
    <script src="{{asset("site_assets/js/vendor/jquery-1.11.2.min.js")}}"></script>
    <script src="{{asset("personalmodal/js/prism.js")}}"></script>
    <script src="{{asset("personalmodal/js/bootstrap-show-modal.js")}}"></script>
    <script src="{{asset("site_assets/js/theia-sticky-sidebar.js")}}"></script>
    <script src="{{asset("site_assets/js/wow.min.js")}}"></script>

<div class="section_title nice_title content-center">
    <h3>{{$dataHeader['keyWorld']['servicios_agregados']}}</h3>
</div>
<div class="container margin_60">
    <div class="row">
        <div class="col-lg-9 col-md-8">
            @include('site.layouts.service.body.service-component')

        </div>
        <div class="col-lg-3 col-md-4 sidebar">

            <div class="theiaStickySidebar">
                <div class="box_style_3" id="general_facilities">
                    <div class="hotel_booking_area clearfix">
                        <div class="hotel_booking3">
                            <form id="form1" role="form" action="#" class="">
                                <div class="col-lg-12 col-md-12">
                                    <div class="room_book">
                                        <h6>Book Your</h6>
                                        <p>Rooms</p>
                                    </div>
                                </div>
                                <div class="form-group col-lg-12 col-md-12">
                                    <div class="input-group border-bottom-dark-2">
                                        <input class="date-picker" id="datepicker"
                                               placeholder={{$dataHeader['keyWorld']['llegada']}} type="text"/>
                                        <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                                <div class="form-group col-lg-12 col-md-12">
                                    <div class="input-group border-bottom-dark-2">
                                        <input class="date-picker" id="datepicker1"
                                               placeholder={{$dataHeader['keyWorld']['salida']}} type="text"/>
                                        <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12">
                                    <div class="row">

                                        <div class="form-group col-lg-12 col-md-12">
                                            <div class="input-group border-bottom-dark-2">
                                                <input id="inputguest"
                                                       placeholder={{$dataHeader['keyWorld']['cant_personal_field']}} type="text"/>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12">
                                    <a class="btn btn-warning btn-md floatright">Book</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div><!-- End row -->
</div><!-- End container -->

<form id="formGeneral2" hidden>
    <div id="addField2">

    </div>

</form>
<script>
    jQuery('.sidebar').theiaStickySidebar({
        additionalMarginTop: 120
    });
    var option = '';
    var fieldTemp = '';
    var totalPersonal = 1;
    var totalRoom = 1;
    $(document).ready(function () {

        $('#inputguest').bind("click", function () {
            var modals = $('.modal-sm');
            totalPersonal = 1;
            totalRoom = 1;
            if(modals.length>0){
                modals[0].remove();
            }
            $.showModal({
                modalDialogClass: 'modal-sm',
                title: 'Huéspedes',
                body:
                    $('#formGeneral2').html(),
                footer:
                    '<button id="submitButton2" type="submit" class="btn btn-primary btn-sm" data-dismiss="modal">1 hab,1 hués</button>',
                onCreate: function (modal) {
                    // create event handler for form submit and handle values
                    $(modal.element).on("click", "button[type='submit']", function (event) {
                        event.preventDefault()
                        var $form = $(modal.element).find("form");
                        $('#inputguest')[0].placeholder = totalRoom + ' hab, ' + totalPersonal + ' hués';
                       /* $.showAlert({
                            title: "Result",
                            body:
                                "<b>text:</b> " + $form.find("#text").val() + "<br/>" +
                                "<b>select:</b> " + $form.find("#select").val() + "<br/>" +
                                "<b>textarea:</b> " + $form.find("#textarea").val()
                        })*/
                    })
                }
            });
            $('.modal-body').append(fieldTemp);
        });
    });

    function addRoom() {
        $('.modal-body').append(fieldTemp);
        if ($('.delete-room')[0]) $('.delete-room')[0].hidden = false;
        totalRoom += 1;
        updateTextButton();

    }

    function deleteRoom(elem) {
        elem.parentElement.parentElement.remove();
        totalRoom -= 1;
        updateTextButton();
    }


    function minusAdultButton(elem) {
        var numberField = elem.parentElement.getElementsByClassName('uitk-step-input-value')[0];
        if (parseInt(numberField.value) >= 2) {
            numberField.value = parseInt(numberField.value) - 1;
            totalPersonal -= 1;
            updateTextButton();
        }
    }

    function minusChildrenButton(elem) {
        var numberField = elem.parentElement.getElementsByClassName('uitk-step-input-value')[0];
        if (parseInt(numberField.value) >= 1) {
            numberField.value = parseInt(numberField.value) - 1;
            totalPersonal -= 1;
            updateTextButton();
        }

    }

    function maxButton(elem) {
        var numberField = elem.parentElement.getElementsByClassName('uitk-step-input-value')[0];
        numberField.value = parseInt(numberField.value) + 1;
        totalPersonal += 1;
        updateTextButton();
    }

    function updateTextButton() {
        document.querySelector('#submitButton2').innerHTML = totalRoom + ' hab, ' + totalPersonal + ' hués';
        document.querySelector('#submitButton2').innerText = totalRoom + ' hab, ' + totalPersonal + ' hués';
        document.querySelector('#submitButton2').textContent = totalRoom + ' hab, ' + totalPersonal + ' hués';
    }

</script>
<script src="{{asset("personalmodal/js/jquery.min.js")}}"></script>
<script src="{{asset("personalmodal/js/prism.js")}}"></script>
<script src="{{asset("personalmodal/js/bootstrap-show-modal.js")}}"></script>

<div class="hotel_booking_area">
    <div class="container">
        <div class="hotel_booking">
            <form id="form1" role="form" action="#" class="">
                <div class="col-lg-2 col-md-2 col-sm-2">
                    <div class="room_book border-right-dark-1">
                        <h6>Book Your</h6>
                        <p>Rooms</p>
                    </div>
                </div>
                <div class="form-group col-lg-2 col-md-2 col-sm-2">
                    <div class="input-group border-bottom-dark-2">
                        <input class="date-picker" id="datepicker"
                               placeholder={{$dataHeader['keyWorld']['llegada']}} type="text"/>
                        <div class="input-group-addon"><i
                                    class="fa fa-calendar"></i></div>
                    </div>
                </div>
                <div class="form-group col-lg-2 col-md-2 col-sm-2">
                    <div class="input-group border-bottom-dark-2">
                        <input class="date-picker" id="datepicker1"
                               placeholder={{$dataHeader['keyWorld']['salida']}} type="text"/>
                        <div class="input-group-addon"><i
                                    class="fa fa-calendar"></i></div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="row">
                        <div class="form-group col-lg-7 col-md-7 col-sm-7 icon_arrow">
                            <div class="input-group border-bottom-dark-2">
                                <select onchange="selectHostal(this)"
                                        class="form-control" name="room"
                                        id="room">
                                    <option selected="selected"
                                            disabled="disabled">{{$dataHeader['keyWorld']['select_hostal']}}</option>
                                    @foreach ($dataHeader['hostales'] as $item)
                                        <option data-hostal={{$loop->index}} value={{$item['id']}}>{{$item['name']}}</option>
                                    @endforeach

                                </select>
                            </div>
                        </div>
                        <div class="form-group col-lg-4 col-md-4 col-sm-4">
                            <div class="input-group border-bottom-dark-2">
                                <select id="button-form" class="form-control">
                                    <option selected="selected"
                                            disabled="disabled">Huéspedes
                                    </option>

                                </select>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                     <a type="button" class="btn btn-primary floatright">Reservar</a>
                 </div>-->
            </form>
            <!-- special offer start -->
            <div class="special_offer_main">
                <img src="{{URL::asset('site_assets/img/special-offer-main.png')}}">
            </div>
            <!-- end offer start -->
        </div>
    </div>
</div>

<form id="formGeneral" hidden>
    <div id="addField">

    </div>

</form>

<script>
    var option = '';
    var fieldTemp = '';
    var totalPersonal = 1;
    var totalRoom = 1;
    $(document).ready(function () {
        $('#button-form').bind("click", function () {
            $.showModal({
                modalDialogClass: 'modal-sm',
                title: 'Huéspedes',
                body:
                    $('#formGeneral').html(),
                footer:
                    '<button id="submitButton" type="submit" class="btn btn-primary btn-sm">1 hab,1 hués</button>',
                onCreate: function (modal) {
                    // create event handler for form submit and handle values
                    $(modal.element).on("click", "button[type='submit']", function (event) {
                        event.preventDefault()
                        var $form = $(modal.element).find("form")
                        $.showAlert({
                            title: "Result",
                            body:
                                "<b>text:</b> " + $form.find("#text").val() + "<br/>" +
                                "<b>select:</b> " + $form.find("#select").val() + "<br/>" +
                                "<b>textarea:</b> " + $form.find("#textarea").val()
                        })
                        modal.hide()
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

    function selectHostal(elem) {
        var indexHostal = elem.options[elem.selectedIndex].getAttribute('data-hostal');
        var hostales = @json($data['hostales']);
        var rooms = hostales[parseInt(indexHostal)].rooms;

        $.each(rooms, function (index, value) {
            option += '<option value=' + value.id + '>' + value.name + '</option>'
        });

        fieldTemp = ' <div class="dinamic-field">\n' +
            '        <div class="form-group row">\n' +
            '        <div class="col-lg-9 col-md-9 col-sm-9">\n' +
            '            <div class="input-group">\n' +
            '                <select class="form-control-sm " name="room">\n' +
            option +

            '                </select>\n' +
            '            </div>\n' +
            '    </div>\n' +
            '    </div>\n' +
            '        <div class="form-group row">\n' +
            '        <div class="col-lg-2 col-md-2 col-sm-2" style="padding-bottom: 10px;padding-top: 10px;"><label for="text">Adultos</label></div>\n' +
            '        <div class="" style="padding-left: 180px;">' +
            '<div>\n' +
            '    <button type="button" onclick="minusAdultButton(this)" class="uitk-button uitk-button-small uitk-step-input-button">\n' +
            '\t<span class="uitk-button-container">\n' +
            '\t\t<span class="uitk-icon uitk-step-input-icon uitk-icon-medium">\n' +
            '\t\t\t<svg aria-labelledby="uitk-step-decrease-adultos-604-title" height="100%" role="img" viewBox="0 0 24 24" width="100%" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">\n' +
            '\t\t\t\t<title>Quitar un adulto</title>\n' +
            '\t\t\t\t<svg><path d="M19 13H5v-2h14v2z"></path></svg>\n' +
            '\t\t\t</svg>\n' +
            '\t\t</span>\n' +
            '\t</span>\n' +
            '</button>\n' +
            '\t<input type="text" class="uitk-step-input-value" min="1" max="14" tabindex="-1" value="1" readonly="">\n' +
            '\t<button type="button" onclick="maxButton(this)" class="uitk-button uitk-button-small uitk-step-input-button">\n' +
            '\t\t<span class="uitk-button-container">\n' +
            '\t\t\t<span class="uitk-icon uitk-step-input-icon uitk-icon-medium">\n' +
            '\t\t\t\t<svg aria-labelledby="uitk-step-increase-adultos-486-title" height="100%" role="img" viewBox="0 0 24 24" width="100%" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">\n' +
            '\t\t\t\t\t<title>Agregar un adulto</title>\n' +
            '\t\t\t\t\t<svg>\n' +
            '\t\t\t\t\t\t<path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z"></path>\n' +
            '\t\t\t\t\t</svg>\n' +
            '\t\t\t\t</svg>\n' +
            '\t\t\t</span>\n' +
            '\t\t</span>\n' +
            '\t</button>\n' +
            '</div>' +
            '</div>\n' +
            '    </div>\n' +
            '        <div class="form-group row">\n' +
            '        <div class="col-lg-2 col-md-2 col-sm-2" style="padding-bottom: 10px;padding-top: 10px;"><label for="text">Niños</label></div>\n' +
            '        <div class="" style="padding-left: 180px;">' +
            '<div>\n' +
            '    <button type="button"  onclick="minusChildrenButton(this)" class="uitk-button uitk-button-small uitk-step-input-button">\n' +
            '\t<span class="uitk-button-container">\n' +
            '\t\t<span class="uitk-icon uitk-step-input-icon uitk-icon-medium">\n' +
            '\t\t\t<svg aria-labelledby="uitk-step-decrease-adultos-604-title" height="100%" role="img" viewBox="0 0 24 24" width="100%" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">\n' +
            '\t\t\t\t<title>Quitar un adulto</title>\n' +
            '\t\t\t\t<svg><path d="M19 13H5v-2h14v2z"></path></svg>\n' +
            '\t\t\t</svg>\n' +
            '\t\t</span>\n' +
            '\t</span>\n' +
            '</button>\n' +
            '\t<input type="text" id="room-2-0-adults" class="uitk-step-input-value" min="1" max="14" tabindex="-1" value="0" readonly="">\n' +
            '\t<button onclick="maxButton(this)" type="button" class="uitk-button uitk-button-small uitk-step-input-button">\n' +
            '\t\t<span class="uitk-button-container">\n' +
            '\t\t\t<span class="uitk-icon uitk-step-input-icon uitk-icon-medium">\n' +
            '\t\t\t\t<svg aria-labelledby="uitk-step-increase-adultos-486-title" height="100%" role="img" viewBox="0 0 24 24" width="100%" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">\n' +
            '\t\t\t\t\t<title>Agregar un adulto</title>\n' +
            '\t\t\t\t\t<svg>\n' +
            '\t\t\t\t\t\t<path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z"></path>\n' +
            '\t\t\t\t\t</svg>\n' +
            '\t\t\t\t</svg>\n' +
            '\t\t\t</span>\n' +
            '\t\t</span>\n' +
            '\t</button>\n' +
            '</div>' +
            '</div>\n' +
            '    </div >\n' +
            '    <div class="delete-room" style="padding-left: 160px;" hidden>\n' +
            '<button type="button" onClick="deleteRoom(this)" className="btn-outline-light">Eliminar Habitación' +
            ' </button>' +
            '    </div >\n' +
            '<hr>' +
            '    </div>';
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
        document.querySelector('#submitButton').innerHTML = totalRoom + ' hab, ' + totalPersonal + ' hués';
        document.querySelector('#submitButton').innerText = totalRoom + ' hab, ' + totalPersonal + ' hués';
        document.querySelector('#submitButton').textContent = totalRoom + ' hab, ' + totalPersonal + ' hués';
    }

</script>
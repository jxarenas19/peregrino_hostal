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

<script>
    var option = '';
    var fieldTemp = '';
    var fieldTemp2 = '';
    var totalPersonal = 1;
    var totalRoom = 1;
    var roomMaxPeople = 0;
    var roomBooking = ''
    $(document).ready(function () {
        $('#button-form').bind("click", function () {
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
                    $('#formGeneral').html(),
                footer:
                    '<button id="submitButton" type="submit" class="btn btn-primary btn-sm" data-dismiss="modal">1 hab,1 hués</button>',
                onCreate: function (modal) {
                    // create event handler for form submit and handle values
                    $(modal.element).on("click", "button[type='submit']", function (event) {
                        event.preventDefault()
                        var $form = $(modal.element).find("form");
                        $('#button-form')[0].placeholder = totalRoom + ' hab, ' + totalPersonal + ' hués';

                        var hostal_selected = $('#room')[0];
                        var hostal_index = hostal_selected.options[hostal_selected.selectedIndex].getAttribute('data-hostal');
                        var hostal = @json($data['hostales'])[hostal_index];
                        $.each($('.dinamic-field'), function (index, value) {
                            var indexRoom = value.querySelector("select[name=room]").getAttribute('data-index-room-select');
                            var cantChild = value.querySelector("select[name=room]").getAttribute('data-total-children');
                            var cantAdult = value.querySelector("select[name=room]").getAttribute('data-total-adult');

                            var roomBooking = createRoomBooking(hostal.rooms[indexRoom],{'adults':cantAdult,'childrens':cantChild});

                            $('#addRoomBooking').append(roomBooking);
                        });
                        $('#infoButton').removeAttr('disabled');

                        /*$.showAlert({
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
    function createRoomBooking(room,dataBooking){
        var conforts = '';
        $.each(room['conforts'], function (index, value) {
            conforts += '<li>\n' +
                '                                <div class="tooltip_styled tooltip-effect-4">\n' +
                '                                    <span class="tooltip-item"><i class='+value['icon']+'></i></span>\n' +
                '                                    <div class="tooltip-content">\n' +
                '                                        '+value['name']+
                '                                    </div>\n' +
                '                                </div>\n' +
                '                            </li>';
        });
        roomBooking = '<div class="row margin-top-20" >\n' +
            '                <div class="col-lg-3 col-md-3 col-sm-5">\n' +
            '                    <img class="img-responsive styled" src='+room['images']['info'][0].url+' alt="">\n' +
            '                </div>\n' +
            '                <div class="col-lg-7 col-md-7 col-sm-8">\n' +
            '                    <div class="room_cost">\n' +
            '                        <div class="row">\n' +
            '                            <div class="col-lg-7 col-md-7">\n' +
            '                                <div class="table-responsive">\n' +
            '                                    <table class="table table-bordered">\n' +
            '                                        <tr class="room_table">\n' +
            '                                            <td class=""><span class="imp_table_text">'+room['name']+'</span> <br>'+dataBooking['adults']+' Adult & '+dataBooking['childrens']+' child</td>\n' +
            '                                            <td class=""><span class="imp_table_text">'+room['priceActual']+'$</span> <br> por noche</td>\n' +
            '                                            <td class=""><span class="imp_table_text">'+dataBooking['diffInDays']+'</span> <br>noche</td>\n' +
            '                                        </tr>\n' +
            '                                    </table>\n' +
            '                                </div>\n' +
            '                            </div>\n' +
            '                        </div>\n' +
            '                    </div>\n' +
            '                </div>\n' +
            '                <div class="col-lg-9 col-md-9 col-sm-7">\n' +
            '                    <div class="row">\n' +

            '                        <div class="col-md-5 room_list_desc3">\n' +
            '                            <ul>\n' +
            conforts+
            '\n' +
            '                        </ul>\n' +
            '                        </div>\n' +
            '\n' +
            '                    </div>\n' +
            '                </div>\n' +

            '            </div>';
        return roomBooking;
    }

    function addRoom() {

        $('.modal-body').append(fieldTemp2);
        /*La idea es que cuando selecciona una nueva room
        * no se debe poder seleccionar un tipo de room q ya este escogido*/
        totalRoom += 1;
        updateTextButton();

    }

    function deleteRoom(elem) {
        elem.parentElement.parentElement.remove();
        totalRoom -= 1;
        updateTextButton();
    }

    function selectHostal(elem) {
        try{
            var indexHostal = elem.options[elem.selectedIndex].getAttribute('data-hostal');
        }
        catch (e) {
            var indexHostal = 0
        }
        var hostales = @json($data['hostales']);
        var rooms = hostales[parseInt(indexHostal)].rooms;

        $.each(rooms, function (index, value) {
            option += '<option  value-index='+index+' data-count-people='+value.countPeople+' value=' + value.id + '>' + value.name + '</option>'
        });
        roomMaxPeople = rooms[0].countPeople;
        fieldTemp = ' <div class="dinamic-field">\n' +
            '        <div class="form-group row">\n' +
            '        <div class="col-lg-9 col-md-9 col-sm-9">\n' +
            '            <div class="input-group icon_arrow">\n' +
            '                <select data-index-room-select=0 data-total-children=0 data-total-adult=1 data-total-people=1 onchange="selectRoom(this)" class="form-control-sm " name="room">\n' +
            option +

            '                </select>\n' +
            '            </div>\n' +
            '    </div>\n' +
            '    </div>\n' +
            '        <div class="form-group row">\n' +
            '        <div class="col-lg-2 col-md-2 col-sm-2" style="padding-bottom: 10px;padding-top: 10px;"><label for="text">Adultos</label></div>\n' +
            '        <div class="" style="padding-left: 60%;">' +
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
            '        <div class="" style="padding-left: 60%;">' +
            '<div>\n' +
            '    <button type="button"  onclick="minusChildrenButton(this)" class="uitk-button uitk-button-small uitk-step-input-button">\n' +
            '\t<span class="uitk-button-container">\n' +
            '\t\t<span class="uitk-icon uitk-step-input-icon uitk-icon-medium">\n' +
            '\t\t\t<svg aria-labelledby="uitk-step-decrease-adultos-604-title" height="100%" role="img" viewBox="0 0 24 24" width="100%" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">\n' +
            '\t\t\t\t<title>Quitar niño</title>\n' +
            '\t\t\t\t<svg><path d="M19 13H5v-2h14v2z"></path></svg>\n' +
            '\t\t\t</svg>\n' +
            '\t\t</span>\n' +
            '\t</span>\n' +
            '</button>\n' +
            '\t<input type="text" class="uitk-step-input-value" min="1" max="14" tabindex="-1" value="0" readonly="">\n' +
            '\t<button onclick="maxChildrenButton(this)" type="button" class="uitk-button uitk-button-small uitk-step-input-button">\n' +
            '\t\t<span class="uitk-button-container">\n' +
            '\t\t\t<span class="uitk-icon uitk-step-input-icon uitk-icon-medium">\n' +
            '\t\t\t\t<svg aria-labelledby="uitk-step-increase-adultos-486-title" height="100%" role="img" viewBox="0 0 24 24" width="100%" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">\n' +
            '\t\t\t\t\t<title>Agregar niño</title>\n' +
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
            '    <div class="delete-room" style="padding-left: 148px;" hidden>\n' +
            '<button type="button" onClick="deleteRoom(this)" className="btn-outline-light">Eliminar Habitación' +
            ' </button>' +
            '    </div >\n' +
            '<hr>' +
            '    </div>';

        fieldTemp2 = ' <div class="dinamic-field">\n' +
            '        <div class="form-group row">\n' +
            '        <div class="col-lg-9 col-md-9 col-sm-9">\n' +
            '            <div class="input-group icon_arrow">\n' +
            '                <select data-index-room-select=0 data-total-children=0 data-total-adult=1 data-total-people=1 onchange="selectRoom(this)" class="form-control-sm " name="room">\n' +
            option +

            '                </select>\n' +
            '            </div>\n' +
            '    </div>\n' +
            '    </div>\n' +
            '        <div class="form-group row">\n' +
            '        <div class="col-lg-2 col-md-2 col-sm-2" style="padding-bottom: 10px;padding-top: 10px;"><label for="text">Adultos</label></div>\n' +
            '        <div class="" style="padding-left: 60%;">' +
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
            '        <div class="" style="padding-left: 60%;">' +
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
            '\t<input type="text" class="uitk-step-input-value" min="1" max="14" tabindex="-1" value="0" readonly="">\n' +
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
            '    <div class="delete-room" style="padding-left: 148px;">\n' +
            '<button type="button" onClick="deleteRoom(this)" className="btn-outline-light">Eliminar Habitación' +
            ' </button>' +
            '    </div >\n' +
            '<hr>' +
            '    </div>';


    }

    function selectRoom(elem){
        roomMaxPeople = elem.item(
            elem.selectedIndex).getAttribute('data-count-people');
        roomIndex = elem.item(elem.selectedIndex).getAttribute('value-index');
        elem.setAttribute('data-index-room-select',roomIndex);
        resetValueAdult(elem);
        resetValueChildren(elem);
    }
    function resetValueAdult(elem) {
        var fieldMinusAdult = elem.parentElement.parentElement.parentElement.parentElement.
        querySelector("button[onclick='minusAdultButton(this)']");
        for (var i = 0; i <= elem.getAttribute('data-total-adult'); i++) {
            minusAdultButton(fieldMinusAdult);
        }

    }
    function resetValueChildren(elem) {
        var fieldMinusAdult = elem.parentElement.parentElement.parentElement.parentElement.
        querySelector("button[onclick='minusChildrenButton(this)']");
        for (var i = -1; i <= elem.getAttribute('data-total-children'); i++) {
            minusChildrenButton(fieldMinusAdult);
        }

    }
    function minusAdultButton(elem) {

        var numberField = elem.parentElement.getElementsByClassName('uitk-step-input-value')[0];
        if (parseInt(numberField.value) >= 2) {
            numberField.value = parseInt(numberField.value) - 1;
            totalPersonal -= 1;
            updateTextButton();
            var newValue = parseInt(getSelectFieldParent(elem).getAttribute('data-total-people'))-1;
            setRoomPeople(elem,newValue);
            updateBookInfo(elem,'data-total-adult',numberField.value);
        }
    }
    function minusChildrenButton(elem) {
        var numberField = elem.parentElement.getElementsByClassName('uitk-step-input-value')[0];
        if (parseInt(numberField.value) >= 1) {
            numberField.value = parseInt(numberField.value) - 1;
            totalPersonal -= 1;
            updateTextButton();
            var newValue = parseInt(getSelectFieldParent(elem).getAttribute('data-total-people'))-1;
            setRoomPeople(elem,newValue);
            updateBookInfo(elem,'data-total-children',numberField.value);
        }

    }

    function maxButton(elem) {
        var maxValue= getMaxPeople(elem);
        var actualValue = getRoomPeople(elem);

        if (maxValue>actualValue) {
            var numberField = elem.parentElement.getElementsByClassName('uitk-step-input-value')[0];
            numberField.value = parseInt(numberField.value) + 1;
            totalPersonal += 1;
            updateTextButton();
            var newValue = parseInt(getSelectFieldParent(elem).getAttribute('data-total-people'))+1;
            setRoomPeople(elem,newValue);
            updateBookInfo(elem,'data-total-adult',numberField.value);
        }

    }

    function updateBookInfo(elem,attribute,value) {
        getSelectFieldParent(elem).setAttribute(attribute,value)
    }

    function maxChildrenButton(elem) {
        var maxValue= getMaxPeople(elem);
        var actualValue = getRoomPeople(elem);
        if (maxValue>actualValue) {
            var numberField = elem.parentElement.getElementsByClassName('uitk-step-input-value')[0];
            numberField.value = parseInt(numberField.value) + 1;
            totalPersonal += 1;
            updateTextButton();
            var newValue = parseInt(getSelectFieldParent(elem).getAttribute('data-total-people'))+1;
            setRoomPeople(elem,newValue);
            updateBookInfo(elem,'data-total-children',numberField.value);
        }

    }

    function getSelectFieldParent(elem){
        return elem.parentElement.parentElement.
            parentElement.parentElement.querySelector("select[name=room]");
    }

    function getMaxPeople(elem){
        var selectField = getSelectFieldParent(elem);
        var cant = selectField.item(
            selectField.selectedIndex).getAttribute('data-count-people');
        return parseInt(cant);
    }

    function getRoomPeople(elem) {
        var selectField =  getSelectFieldParent(elem);
        return parseInt(selectField.getAttribute('data-total-people'));
    }

    function setRoomPeople(elem,value) {
        var selectField =  getSelectFieldParent(elem).setAttribute("data-total-people",value);
    }

    function updateTextButton() {
        document.querySelector('#submitButton').innerHTML = totalRoom + ' hab, ' + totalPersonal + ' hués';
        document.querySelector('#submitButton').innerText = totalRoom + ' hab, ' + totalPersonal + ' hués';
        document.querySelector('#submitButton').textContent = totalRoom + ' hab, ' + totalPersonal + ' hués';
    }

</script>
var option = '';
var fieldTemp = '';
var totalPersonal = 1;
var totalPersonalOriginal = 1;
var totalRoom = 1;
var totalRoomOriginal = 1;
var tempFieldSave = '';
var roomMaxPeople = 0;
var eliminadoField = [];
var deletedFields = [];
$(document).ready(function () {
    $('#button-form').bind("click", function () {
        var modals = $('.modal-sm');
        var modalCreated = '';
        getRoomOptions();
        if (modals.length > 0) {
            modals[0].remove();
            modalCreated = modalCreate();
            if (tempFieldSave === '') {
                $('.modal-body').append(fieldTemp);
            }
            else {
                $('.modal-body').append(tempFieldSave);
                $.each(deletedFields, function (index, value) {
                    $('#'+value).remove();
                });
            }
        }
        else {
            modalCreated = modalCreate();
            if (fieldTemp === '') {
                fieldTemp = createElementDinamic(0, 0, 1);
            }
            $('.modal-body').append(fieldTemp);
        }
        $('#' + modalCreated.id).on('hidden.bs.modal', function (e) {
            totalRoom = totalRoomOriginal;
            totalPersonal = totalPersonalOriginal;
            updateTextButton();
        })


    });
    if (dataBooking != null) {
        $('#datepicker')[0].value = dataBooking['begin'];
        $('#datepicker1')[0].value = dataBooking['end'];
        $('#button-form')[0].placeholder = dataBooking['huespedes'];
        $.each($('#room')[0].options, function (index, value) {
            if (value.getAttribute('value') === dataBooking['hostal']) {
                value.setAttribute('selected', 'selected');

            }
        });
        totalRoom = 0;
        totalPersonal = 0;
        $.each(dataBooking['room'], function (index, room) {
            totalRoom += 1;
            totalPersonal += parseInt(room.adults) + parseInt(room.childrens);
            totalPersonalOriginal = totalPersonal;
            totalRoomOriginal = totalRoom;
            fieldTemp += createElementDinamic(room['index_room'], parseInt(room.childrens), parseInt(room.adults));
            $.each(hostales[0]['rooms'], function (index2, value) {
                if (value.id === room['id_room']) {
                    room['diffInDays'] = dataBooking['diffInDays'];
                    var roomBooking = createRoomBooking(value, room);
                    $('#addRoomBooking').append(roomBooking);
                    bookingJson.bookingRoom[room['index_room']] = {
                        'begin':dataBooking['begin'],
                        'end':dataBooking['end'],
                        'adults': parseInt(room.adults),
                        'childrens': parseInt(room.childrens),
                        'diffInDays': room['diffInDays'],
                        'index_room':room['index_room'],
                        'name':value.name,
                        'price':room['priceActual'],
                        'id_room':room['id_room']
                    };
                }

            });
            bookingJson.generalBookingData = {
                'hostal':hostales[0]['id']
            };
        });

        $('#infoButton').removeAttr('disabled');
    }
});

function modalCreate() {

    return $.showModal({
        modalDialogClass: 'modal-sm',
        title: 'Huéspedes',
        body:
            $('#formGeneral').html(),
        footer:
            '<button id="submitButton" type="submit" class="btn btn-primary btn-sm" data-dismiss="modal">' +
            '' + totalRoom + ' hab, ' + totalPersonal + ' hués' + '</button>',
        onCreate: function (modal) {
            // create event handler for form submit and handle values
            $(modal.element).on("click", "button[type='submit']", function (event) {
                deleteRoomBookingChildren($('#addRoomBooking'));
                event.preventDefault()
                var $form = $(modal.element).find("form");
                $('#button-form')[0].placeholder = totalRoom + ' hab, ' + totalPersonal + ' hués';
                totalPersonalOriginal = totalPersonal;
                totalRoomOriginal = totalRoom;
                tempFieldSave = $('.modal-body').children();
                var hostal_selected = $('#room')[0];
                var hostal_index = hostal_selected.options[hostal_selected.selectedIndex].getAttribute('data-hostal');
                var hostal_value = hostal_selected.options[hostal_selected.selectedIndex].getAttribute('value');
                var beginDate = $('#datepicker')[0];
                var endDate = $('#datepicker1')[0];
                var huesp = $('#button-form')[0].placeholder;
                var begin = beginDate.value;
                var end = endDate.value;
                var hostal = hostales[hostal_index];
                var allRoom = [];
                var allRoomNew = [];

                var beginObject = new Date(begin.split('/')[1] + '-' + begin.split('/')[0] + '-' + begin.split('/')[2]);
                var endObject = new Date(end.split('/')[1] + '-' + end.split('/')[0] + '-' + end.split('/')[2]);
                var diffInDays = Math.ceil(Math.abs(endObject - beginObject) / (1000 * 60 * 60 * 24));
                $.each($('.dinamic-field'), function (index, value) {
                    var indexRoom = value.querySelector("select[name=room]").getAttribute('data-index-room-select');

                    var info_photo = hostal.rooms[indexRoom].images.info[0].url;
                    var dataSend = {};
                    dataSend['childrens'] = value.querySelector("select[name=room]").getAttribute('data-total-children');
                    dataSend['adults'] = value.querySelector("select[name=room]").getAttribute('data-total-adult');
                    dataSend['id_room'] = hostal.rooms[indexRoom].id;
                    dataSend['name'] = hostal.rooms[indexRoom].name;
                    dataSend['price'] = hostal.rooms[indexRoom].priceActual;
                    dataSend['index_room'] = indexRoom;
                    allRoom.push(dataSend);
                    try {
                        var previewBookking = document.querySelector('#'+hostal.rooms[indexRoom].name).querySelector('tr');
                    }
                    catch (e) {
                        previewBookking = null;
                    }
                    if (previewBookking!==null) {
                        childreens = previewBookking.children;
                        updateTextPreviewBookingOne(childreens[0],dataSend,hostal.rooms[indexRoom]);
                    }
                    else{
                        allRoomNew.push(dataSend);
                    }
                });
                var bookingButton = $('#bookingButton')[0];
                if (bookingButton !== undefined) {
                    bookingButton.href = "booking?data=" + (JSON.stringify({
                        'rooms': allRoom,
                        'hostal': hostal_value,
                        'huespedes': huesp,
                        'diffInDays': diffInDays,
                        'begin': begin,
                        'end': end
                    }));
                }
                else {
                    bookingJson.bookingRoom = {};
                    $.each(allRoomNew, function (index, value) {
                        bookingJson.bookingRoom[value['index_room']] = {
                            'begin':beginDate.value,
                            'end':endDate.value,
                            'adults': value['adults'],
                            'childrens': value['childrens'],
                            'diffInDays': diffInDays,
                            'index_room':value['index_room'],
                            'id_room':value['id_room'],
                            'name':value['name'],
                            'price':value['price'],
                        };

                        var roomBooking = createRoomBooking(hostal.rooms[value['index_room']],
                            {
                                'adults': value['adults'],
                                'childrens': value['childrens'],
                                'diffInDays': diffInDays,
                                'index_room':value['index_room']
                            });
                        $('#addRoomBooking').append(roomBooking);
                    });
                    bookingJson.generalBookingData = {
                        'hostal':hostal.id
                    };
                    $('#infoButton').removeAttr('disabled');
                }


            })
        }
    });
}

function addRoom() {
    $('.modal-body').append(createElementDinamic(0, 0, 1));
    /*La idea es que cuando selecciona una nueva room
        * no se debe poder seleccionar un tipo de room q ya este escogido*/
    totalRoom += 1;
    totalPersonal += 1;
    updateTextButton();

}

function createRoomBooking(room, dataBooking) {
    var conforts = '';
    $.each(room['conforts'], function (index, value) {
        conforts += '<li>\n' +
            '                                <div class="tooltip_styled tooltip-effect-4">\n' +
            '                                    <span class="tooltip-item"><i class=' + value['icon'] + '></i></span>\n' +
            '                                    <div class="tooltip-content">\n' +
            '                                        ' + value['name'] +
            '                                    </div>\n' +
            '                                </div>\n' +
            '                            </li>';
    });
    roomBooking = '<div id="'+room.name+'" class="col-lg-6 col-md-6 col-sm-6 margin-top-20 datos-general-room" >\n' +
        '                <div class="col-lg-9 col-md-3 col-sm-5">' +
        '                   <figure class="uk-overlay uk-overlay-hover">\n' +
        '                       <img class="img-responsive styled" src=' + room['images']['info'][0].url + ' alt="">' +
        '                       <figcaption class="uk-overlay-panel details-room-delete uk-flex uk-flex-center uk-flex-middle uk-text-center">' +
        '                           <div><span data-total-children="'+dataBooking['childrens']+'" data-total-adult="'+dataBooking['adults']+'" data-index-room="'+dataBooking['index_room']+'" data-tipo-room="'+room.name+'" onclick="deleteRoomBooking(this)" style="cursor: pointer;color: #000000;"><i style="font-size: 60px;" class="icon-trash"></i></span></div>' +
        '                       </figcaption>' +
        '                   </figure>\n' +
        '                </div>\n' +
        '                <div class="col-lg-9 col-md-7 col-sm-8 datos-room">\n' +
        '                    <div class="room_cost">\n' +
        '                        <div class="row">\n' +
        '                            <div class="col-lg-12 col-md-12">\n' +
        '                                <div class="table-responsive">\n' +
        '                                    <table class="table table-bordered">\n' +
        '                                        <tr class="room_table">\n' +
        '                                            <td class=""><span class="imp_table_text ">' + room['name'] + '</span> <br>' + dataBooking['adults'] + ' Adult & ' + dataBooking['childrens'] + ' child</td>\n' +
        '                                            <td class=""><span class="imp_table_text">' + room['priceActual'] + '$</span> <br> por noche</td>\n' +
        '                                            <td class=""><span class="imp_table_text">' + dataBooking['diffInDays'] + '</span> <br>noche</td>\n' +
        '                                        </tr>\n' +
        '                                    </table>\n' +
        '                                </div>\n' +
        '                            </div>\n' +
        '                        </div>\n' +
        '                    </div>\n' +
        '                </div>\n' +
        '                <div class="col-lg-9 col-md-9 col-sm-7">\n' +
        '                    <div class="row">\n' +

        '                        <div class="col-md-12 room_list_desc3">\n' +
        '                            <ul>\n' +
        conforts +
        '\n' +
        '                        </ul>\n' +
        '                        </div>\n' +
        '\n' +
        '                    </div>\n' +
        '                </div>\n' +

        '            </div>';
    return roomBooking;
}

function deleteRoomBooking(elem){
    var elemQuery = $(elem);
    var index_room = elem.getAttribute('data-index-room');
    var total_children = elem.getAttribute('data-total-children');
    var total_adult = elem.getAttribute('data-total-adult');
    totalPersonal = totalPersonal -parseInt(total_children)-parseInt(total_adult);
    totalPersonalOriginal = totalPersonalOriginal -parseInt(total_children)-parseInt(total_adult);
    totalRoom -= 1;
    totalRoomOriginal -= 1;
    elemQuery.parents()[4].remove();
    deletedFields.push(index_room);
    delete bookingJson.bookingRoom[index_room];
    updateTextButton();
    $('#button-form')[0].placeholder = totalRoom + ' hab, ' + totalPersonal + ' hués';

}

function deleteRoomBookingChildren(elem) {
    $.each(elem.children(), function (index, value) {
        value.remove();
    });
}

function deleteRoom(elem) {
    eliminadoField.push(elem.parentElement.parentElement.
    querySelector("select[name=room]").getAttribute('data-index-room-select'));
    elem.parentElement.parentElement.remove();
    totalRoom -= 1;
    totalPersonal -= parseInt(elem.parentElement.parentElement
        .querySelector("select[name=room]").getAttribute('data-people'));
    updateTextButton();

}

function selectHostal(elem) {

//aqui lo que debo hacer es habilitar la opcion de al lado cuando
    //escojan un hostal
}

function getRoomOptions() {
    option = '';
    try {
        var indexHostal = $('#room')[0].options[elem.selectedIndex].getAttribute('data-hostal');
    }
    catch (e) {
        var indexHostal = 0
    }

    var rooms = hostales[parseInt(indexHostal)].rooms;

    $.each(rooms, function (index, value) {
        option += '<option value-index=' + index + ' data-count-people=' + value.countPeople + ' value=' + value.id + '>' + value.name + '</option>'
    });
    roomMaxPeople = rooms[0].countPeople;
    return option;
}

//Encargada de crear los field
function createElementDinamic(room_index, total_children, total_adult) {
    option = getRoomOptions();
    return ' <div id="'+room_index+'" class="dinamic-field">\n' +
        '        <div class="form-group row">\n' +
        '        <div class="col-lg-9 col-md-9 col-sm-9">\n' +
        '            <div class="input-group icon_arrow">\n' +
        '                <select data-index-room-select=' + room_index + ' ' +
        'data-total-children=' + total_children + ' ' +
        'data-total-adult=' + total_adult + ' ' +
        'data-people=' + parseInt(total_children + total_adult) + ' onchange="selectRoom(this)" class="form-control-sm select-field" name="room">\n' +
        option +

        '                </select>\n' +
        '            </div>\n' +
        '    </div>\n' +
        '    </div>\n' +
        '        <div class="form-group row">\n' +
        '        <div class="col-lg-2 col-md-2 col-sm-2" style="padding-bottom: 10px;padding-top: 10px;"><label for="text">Adultos</label></div>\n' +
        '        <div class="" style="padding-left: 60%;">' +
        '<div>\n' +
        '<button type="button" onclick="minusAdultButton(this)" class="uitk-button uitk-button-small uitk-step-input-button">\n' +
        '\t<span class="uitk-button-container">\n' +
        '\t\t<span class="uitk-icon uitk-step-input-icon uitk-icon-medium">\n' +
        '\t\t\t<svg aria-labelledby="uitk-step-decrease-adultos-604-title" height="100%" role="img" viewBox="0 0 24 24" width="100%" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">\n' +
        '\t\t\t\t<title>Quitar un adulto</title>\n' +
        '\t\t\t\t<svg><path d="M19 13H5v-2h14v2z"></path></svg>\n' +
        '\t\t\t</svg>\n' +
        '\t\t</span>\n' +
        '\t</span>\n' +
        '</button>\n' +
        '\t<input type="text" class="uitk-step-input-value" value=' + total_adult + ' readonly="">\n' +
        '\t<button type="button" onclick="maxButtonAdult(this)" class="uitk-button uitk-button-small uitk-step-input-button">\n' +
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
        '\t\t\t\t<title>Quitar un niño</title>\n' +
        '\t\t\t\t<svg><path d="M19 13H5v-2h14v2z"></path></svg>\n' +
        '\t\t\t</svg>\n' +
        '\t\t</span>\n' +
        '\t</span>\n' +
        '</button>\n' +
        '\t<input type="text" class="uitk-step-input-value" min="1" max="14" tabindex="-1" value=' + total_children + ' readonly="">\n' +
        '\t<button onclick="maxButtonChildren(this)" type="button" class="uitk-button uitk-button-small uitk-step-input-button">\n' +
        '\t\t<span class="uitk-button-container">\n' +
        '\t\t\t<span class="uitk-icon uitk-step-input-icon uitk-icon-medium">\n' +
        '\t\t\t\t<svg aria-labelledby="uitk-step-increase-adultos-486-title" height="100%" role="img" viewBox="0 0 24 24" width="100%" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">\n' +
        '\t\t\t\t\t<title>Agregar un niño</title>\n' +
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
        '<button type="button" id="buttonDel" onClick="deleteRoom(this)" class="btn btn-secondary btn-sm">Eliminar Habitación' +
        ' </button>' +
        '    </div >\n' +
        '<hr>' +
        '    </div>';

}

function selectRoom(elem) {
    roomMaxPeople = $("select[name=room]")[0].item(
        $("select[name=room]")[0].selectedIndex).getAttribute('data-count-people');
    roomIndex = elem.item(elem.selectedIndex).getAttribute('value-index');
    elem.setAttribute('data-index-room-select', roomIndex);
    elem.parentElement.parentElement.parentElement.parentElement.setAttribute('id',roomIndex);
    resetValueAdult(elem);
    resetValueChildren(elem);

}

function resetValueAdult(elem) {
    var fieldMinusAdult = elem.parentElement.parentElement.parentElement.parentElement.querySelector("button[onclick='minusAdultButton(this)']");
    for (var i = 0; i <= elem.getAttribute('data-total-adult'); i++) {
        minusAdultButton(fieldMinusAdult);
    }

}

function resetValueChildren(elem) {
    var fieldMinusAdult = elem.parentElement.parentElement.parentElement.parentElement.querySelector("button[onclick='minusChildrenButton(this)']");
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
        setRoomPeopleMinus(elem);
        updateBookInfo(elem, 'data-total-adult', numberField.value);
    }
}

function minusChildrenButton(elem) {
    var numberField = elem.parentElement.getElementsByClassName('uitk-step-input-value')[0];
    if (parseInt(numberField.value) >= 1) {
        numberField.value = parseInt(numberField.value) - 1;
        totalPersonal -= 1;
        updateTextButton();
        setRoomPeopleMinus(elem);
        updateBookInfo(elem, 'data-total-children', numberField.value);
    }

}

function updateBookInfo(elem, attribute, value) {
    getSelectFieldParent(elem).setAttribute(attribute, value)
}

function getSelectFieldParent(elem) {
    return elem.parentElement.parentElement.parentElement.parentElement.querySelector("select[name=room]");
}

function maxButtonAdult(elem) {
    var maxValue = getMaxPeople(elem);
    var actualValue = getRoomPeople(elem);
    if (maxValue > actualValue) {
        var numberField = elem.parentElement.getElementsByClassName('uitk-step-input-value')[0];
        numberField.value = parseInt(numberField.value) + 1;
        totalPersonal += 1;
        updateTextButton();
        setRoomPeoplePlus(elem);
        updateBookInfo(elem, 'data-total-adult', numberField.value);
    }

}

function maxButtonChildren(elem) {
    var maxValue = getMaxPeople(elem);
    var actualValue = getRoomPeople(elem);
    if (maxValue > actualValue) {
        var numberField = elem.parentElement.getElementsByClassName('uitk-step-input-value')[0];
        numberField.value = parseInt(numberField.value) + 1;
        totalPersonal += 1;
        updateTextButton();
        setRoomPeoplePlus(elem);
        updateBookInfo(elem, 'data-total-children', numberField.value);
    }

}

function getMaxPeople(elem) {
    var selectField = elem.parentElement.parentElement.parentElement.parentElement.querySelector("select[name=room]");
    var cant = selectField.item(
        selectField.selectedIndex).getAttribute('data-count-people');
    return parseInt(cant);
}

function getRoomPeople(elem) {
    var selectField = elem.parentElement.parentElement.parentElement.parentElement.querySelector("select[name=room]");
    return parseInt(selectField.getAttribute('data-people'));
}

function setRoomPeoplePlus(elem) {
    var selectField = elem.parentElement.parentElement.parentElement.parentElement.querySelector("select[name=room]");
    selectField.setAttribute("data-people", parseInt(selectField.getAttribute('data-people')) + 1);
}

function setRoomPeopleMinus(elem) {
    var selectField = elem.parentElement.parentElement.parentElement.parentElement.querySelector("select[name=room]");
    selectField.setAttribute("data-people", parseInt(selectField.getAttribute('data-people')) - 1);
}

function updateTextButton() {
    document.querySelector('#submitButton').innerHTML = totalRoom + ' hab, ' + totalPersonal + ' hués';
    document.querySelector('#submitButton').innerText = totalRoom + ' hab, ' + totalPersonal + ' hués';
    document.querySelector('#submitButton').textContent = totalRoom + ' hab, ' + totalPersonal + ' hués';
}

function updateTextPreviewBookingOne(elem,data,room){
    elem.innerHTML = '<span class="imp_table_text ">'+room.name+'</span>'+'<br>'+ data.adults+' ADULT & '+data.childrens+' CHILD';
}

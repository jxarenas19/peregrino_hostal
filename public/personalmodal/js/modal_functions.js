var option = '';
var fieldTemp = '';
var fieldTemp2 = '';
var totalPersonal = 1;
var totalRoom = 1;
var tempFieldSave  = '';
var roomMaxPeople = 0;

$(document).ready(function () {

    $('#button-form').bind("click", function () {
        selectHostal(this);
        var modals = $('.modal-sm');
        // totalPersonal = 1;
        // totalRoom = 1;
        if(modals.length>0){
            modals[0].remove();
            $.showModal({
                modalDialogClass: 'modal-sm',
                title: 'Huéspedes',
                body:
                    $('#formGeneral').html(),
                footer:
                    '<button id="submitButton" type="submit" class="btn btn-primary btn-sm" data-dismiss="modal">' +
                    ''+totalRoom + ' hab, ' + totalPersonal + ' hués'+'</button>',
                onCreate: function (modal) {
                    // create event handler for form submit and handle values
                    $(modal.element).on("click", "button[type='submit']", function (event) {
                        event.preventDefault()
                        var $form = $(modal.element).find("form");
                        $('#button-form')[0].placeholder = totalRoom + ' hab, ' + totalPersonal + ' hués';
                        tempFieldSave = $('.modal-body').children();
                    })
                }
            });
            $('.modal-body').append(tempFieldSave);
        }
        else{
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
                        tempFieldSave = $('.modal-body').children();
                    })
                }
            });
            $('.modal-body').append(fieldTemp);
        }

    });
});

function addRoom() {
    $('.modal-body').append(fieldTemp2);
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
    console.log(hostales);
    console.log(indexHostal);
    var rooms = hostales[parseInt(indexHostal)].rooms;

    $.each(rooms, function (index, value) {
        option += '<option data-count-people='+value.countPeople+' value=' + value.id + '>' + value.name + '</option>'
    });
    roomMaxPeople = rooms[0].countPeople;
    fieldTemp = ' <div class="dinamic-field">\n' +
        '        <div class="form-group row">\n' +
        '        <div class="col-lg-9 col-md-9 col-sm-9">\n' +
        '            <div class="input-group icon_arrow">\n' +
        '                <select data-people=1 onchange="selectRoom(this)" class="form-control-sm select-field" name="room">\n' +
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
        '\t\t\t\t<title>Quitar un niño</title>\n' +
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
        '    <div class="delete-room" style="padding-left: 148px;" hidden>\n' +
        '<button type="button" id="buttonDel" onClick="deleteRoom(this)" class="btn btn-secondary btn-sm">Eliminar Habitación' +
        ' </button>' +
        '    </div >\n' +
        '<hr>' +
        '    </div>';
    fieldTemp2 = ' <div class="dinamic-field">\n' +
        '        <div class="form-group row">\n' +
        '        <div class="col-lg-9 col-md-9 col-sm-9">\n' +
        '            <div class="input-group icon_arrow">\n' +
        '                <select data-people=1 onchange="selectRoom(this)" class="form-control-sm select-field" name="room">\n' +
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
        '<button type="button" id="buttonDel" onClick="deleteRoom(this)" class="btn btn-secondary btn-sm">Eliminar Habitación' +
        ' </button>' +
        '    </div >\n' +
        '<hr>' +
        '    </div>';
}

function selectRoom(elem){
    roomMaxPeople = $("select[name=room]")[0].item(
        $("select[name=room]")[0].selectedIndex).getAttribute('data-count-people');

}
function minusAdultButton(elem) {
    var numberField = elem.parentElement.getElementsByClassName('uitk-step-input-value')[0];
    if (parseInt(numberField.value) >= 2) {
        numberField.value = parseInt(numberField.value) - 1;
        totalPersonal -= 1;
        updateTextButton();
        setRoomPeopleMinus(elem,numberField.value);
    }
}
function minusChildrenButton(elem) {
    var numberField = elem.parentElement.getElementsByClassName('uitk-step-input-value')[0];
    if (parseInt(numberField.value) >= 1) {
        numberField.value = parseInt(numberField.value) - 1;
        totalPersonal -= 1;
        updateTextButton();
        setRoomPeopleMinus(elem,numberField.value);
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
        setRoomPeoplePlus(elem,numberField.value)
    }

}
function getMaxPeople(elem){
    var selectField =  elem.parentElement.parentElement.
    parentElement.parentElement.querySelector("select[name=room]");
    var cant = selectField.item(
        selectField.selectedIndex).getAttribute('data-count-people');
    return parseInt(cant);
}
function getRoomPeople(elem) {
    var selectField =  elem.parentElement.parentElement.
    parentElement.parentElement.querySelector("select[name=room]");
    return parseInt(selectField.getAttribute('data-people'));
}
function setRoomPeoplePlus(elem,value) {
    var selectField =  elem.parentElement.parentElement.
    parentElement.parentElement.querySelector("select[name=room]");
    selectField.setAttribute("data-people",parseInt(selectField.getAttribute('data-people'))+1);
}
function setRoomPeopleMinus(elem,value) {
    var selectField =  elem.parentElement.parentElement.
    parentElement.parentElement.querySelector("select[name=room]");
    selectField.setAttribute("data-people",parseInt(selectField.getAttribute('data-people'))-1);
}
function updateTextButton() {
    document.querySelector('#submitButton').innerHTML = totalRoom + ' hab, ' + totalPersonal + ' hués';
    document.querySelector('#submitButton').innerText = totalRoom + ' hab, ' + totalPersonal + ' hués';
    document.querySelector('#submitButton').textContent = totalRoom + ' hab, ' + totalPersonal + ' hués';
}
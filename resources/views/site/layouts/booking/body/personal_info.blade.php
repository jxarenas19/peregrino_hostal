<div role="tabpanel" class="tab-pane" id="personal_info">
    <div class="personal_info_area">
        <div class="hotel_booking4 margin-top-70 margin-bottom-125">
            <form role="form" action="#" class="">
                {{ csrf_field() }}
                <div class="row">
                    <div class="form-group col-lg-4 col-md-4 col-sm-4 icon_arrow">
                        <div class="input-group">
                            <input type="text" id="fieldName" onchange="nombreChange(this)" class="form-control"
                                   placeholder={{$data['keyWorld']['persona_name']}}>
                        </div>
                    </div>
                    <div class="form-group col-lg-4 col-md-4 col-sm-4 icon_arrow">
                        <div class="input-group">
                            <select class="form-control custom-select custom-select-sm" name="country" id="country">
                                <option selected="selected"
                                        disabled="disabled">{{'Nacionalidad'}}</option>

                            </select>
                        </div>
                    </div>
                    <div class="form-group col-lg-4 col-md-4 col-sm-4 icon_arrow">
                        <div class="input-group">
                            <input type="text" id="fieldEmail" class="form-control"
                                   placeholder={{$data['keyWorld']['email']}}>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-lg-6 col-md-6 col-sm-6 icon_arrow">
                        <div class="input-group">
                            <input type="text" id="fieldFlight" class="form-control"
                                   placeholder={{$data['keyWorld']['flight_number']}}>
                        </div>
                    </div>
                    <div class="form-group col-lg-6 col-md-6 col-sm-6 icon_arrow">
                        <div class="input-group">
                            <input type="text" id="fieldHour" class="form-control"
                                   placeholder={{$data['keyWorld']['arrived_hour']}}>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="container">
                        <div class="form-group">
                            <textarea class="form-control" rows="5" id="comment"
                                      placeholder="Any Specific request"></textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="booking_next_btn clearfix border-top-whitesmoke">
                            <a href="#" onclick="goToBack('service_info')"
                               class="btn btn-warning btn-sm btn-info">{{$data['keyWorld']['back']}}</a>
                            <a href="#" onclick="goToFinish()"
                               class="btn btn-warning btn-sm floatright">{{$data['keyWorld']['next']}}</a>
                        </div>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>
<script>
    var totalGastado = 0;
    $(document).ready(function () {
        $.each(country_list, function (index, country) {
            $('#country').append('<option value="' + country[0] + '">' + country[0] + '</option>')
        });

    });

    function addRoomReservadors(responseElement) {

        var table = document.querySelector('#booking_done').querySelector(".table");
        for (var item in responseElement) {
            $(table).append(createRoomRow(responseElement[item]));
        }
    }

    function createRoomRow(data) {
        totalGastado += parseInt(data['price'])*parseInt(data['diffInDays']);
        return '<tr class="room_table">\n' +
            '                                <td class=""><span class="imp_table_text">'+data['name']+'</span> <br>'+data['adults']+' '+keyWorld.adult+' & '+data['childrens'] +' '+ keyWorld.child+'</td>\n' +
            '                                <td class=""><span class="imp_table_text">'+data['price']+'$</span> <br> por noche</td>\n' +
            '                                <td class="">'+data['diffInDays']+' <br>'+keyWorld.night+'</td>\n' +
            '                                <td class=""><span class="imp_table_text">'+parseInt(data['price'])*parseInt(data['diffInDays'])+'$</span></td>\n' +
            '                            </tr>'
    }

    function addServicesReservados(responseElement) {
        var table = document.querySelector('#booking_done').querySelector(".table");
        var total = 0;
        for (var item in responseElement) {
            if(responseElement[item]!=null) total += parseInt(responseElement[item]['price']);
        }
        totalGastado += total;
        $(table).append(createServicesRow(total))
    }

    function createServicesRow(total) {
        return '<tr class="total_table">\n' +
            '                                <td class=""><span class="imp_table_text">Servicios Agregados</span></td>\n' +
            '                                <td class="" colspan="3"><span class="imp_table_text">'+total+'$</span> <br> <span class="total_pain_info">(En servicios)</span></td>\n' +
            '                            </tr>'
    }

    function addTotalRow(){
        var table = document.querySelector('#booking_done').querySelector(".table");
        $(table).append(calculateTotal())
    }

    function calculateTotal(){
        return '<tr class="total_table">\n' +
            '                                <td class=""><span class="imp_table_text">Total</span></td>\n' +
            '                                <td class="" colspan="3"><span class="imp_table_text">'+totalGastado+'$</span> <br> <span class="total_pain_info">(total)</span></td>\n' +
            '                            </tr>'
    }
    function goToFinish() {
        var tabDone = $('#myTab a[href="#booking_done"]');
        tabDone.removeClass('isDisabled');

        tabDone.tab('show');
        bookingJson.generalData = {
            'nombre': $('#fieldName')[0].value,
            'nacionalidad': $('#country')[0].value,
            'mail': $('#fieldEmail')[0].value,
            'aerolinea': $('#fieldFlight')[0].value,
            'hora':  $('#fieldHour')[0].value,
            'others': $('#comment')[0].value
        };
        $('#loader-wrapper').css('display', '');
        $.ajax({
            type: "POST",
            data: {"informacion": (JSON.stringify(bookingJson))},
            'url': 'reservar',
            'success': function (callback) {
                try {
                    $('#status').fadeOut(); // will first fade out the loading animation
                    $('#loader-wrapper').delay(300).fadeOut('slow'); // will fade out the white DIV that covers the website.
                    $('body').delay(350).css({'overflow-x': 'hidden'});
                    response = callback.data;

                    addRoomReservadors(response.bookingRoom);
                    addServicesReservados(response.bookingService);
                    addTotalRow();
                    // alert(JSON.stringify(response));
                    if (response.error !== undefined)
                        throw Error(response.error);
                } catch (e) {
                    $('#status').fadeOut(); // will first fade out the loading animation
                    $('#loader-wrapper').delay(300).fadeOut('slow'); // will fade out the white DIV that covers the website.
                    $('body').delay(350).css({'overflow-x': 'hidden'});
                    console.log(e);
                    return false;
                }
            },
            'error': function (xhr, textStatus, errorThrown) {
                $('#status').fadeOut(); // will first fade out the loading animation
                $('#loader-wrapper').delay(300).fadeOut('slow'); // will fade out the white DIV that covers the website.
                $('body').delay(350).css({'overflow-x': 'hidden'});
                console.log('error')
            }
        });
    }

    function nombreChange(elem) {
        console.log(elem)
    }

    var country_list = [
        [
            "Afghanistan"
        ],
        [
            "Albania"
        ],
        [
            "Algeria"
        ],
        [
            "Andorra"
        ],
        [
            "Angola"
        ],
        [
            "Anguilla"
        ],
        [
            "Antigua y Barbuda"
        ],
        [
            "Argentina"
        ],
        [
            "Armenia"
        ],
        [
            "Aruba"
        ],
        [
            "Australia"
        ],
        [
            "Austria"
        ],
        [
            "Azerbaijan"
        ],
        [
            "Bahamas"
        ],
        [
            "Bahrain"
        ],
        [
            "Bangladesh"
        ],
        [
            "Barbados"
        ],
        [
            "Belarus"
        ],
        [
            "Belgium"
        ],
        [
            "Belize"
        ],
        [
            "Benin"
        ],
        [
            "Bermuda"
        ],
        [
            "Bhutan"
        ],
        [
            "Bolivia"
        ],
        [
            "Bosnia y Herzegovina"
        ],
        [
            "Botswana"
        ],
        [
            "Brazil"
        ],
        [
            "British Virgin Islands"
        ],
        [
            "Brunei"
        ],
        [
            "Bulgaria"
        ],
        [
            "Burkina Faso"
        ],
        [
            "Burundi"
        ],
        [
            "Cambodia"
        ],
        [
            "Cameroon"
        ],
        [
            "Canarias "
        ],
        [
            "Cape Verde"
        ],
        [
            "Cayman Islands"
        ],
        [
            "Chad"
        ],
        [
            "Chile"
        ],
        [
            "China"
        ],
        [
            "Colombia"
        ],
        [
            "Congo"
        ],
        [
            "Cook Islands"
        ],
        [
            "Costa Rica"
        ],
        [
            "Cote D Ivoire"
        ],
        [
            "Croatia"
        ],
        [
            "Cruise Ship"
        ],
        [
            "Cuba"
        ],
        [
            "Cyprus"
        ],
        [
            "Czech Republic"
        ],
        [
            "Denmark"
        ],
        [
            "Djibouti"
        ],
        [
            "Dominica"
        ],
        [
            "Dominican Republic"
        ],
        [
            "Ecuador"
        ],
        [
            "Egypt"
        ],
        [
            "El Salvador"
        ],
        [
            "Equatorial Guinea"
        ],
        [
            "España"
        ],
        [
            "Estonia"
        ],
        [
            "Ethiopia"
        ],
        [
            "Falkland Islands"
        ],
        [
            "Faroe Islands"
        ],
        [
            "Fiji"
        ],
        [
            "Finland"
        ],
        [
            "France"
        ],
        [
            "French Polynesia"
        ],
        [
            "French West Indies"
        ],
        [
            "Gabon"
        ],
        [
            "Gambia"
        ],
        [
            "Georgia"
        ],
        [
            "Germany"
        ],
        [
            "Ghana"
        ],
        [
            "Gibraltar"
        ],
        [
            "Gitania"
        ],
        [
            "Greece"
        ],
        [
            "Greenland"
        ],
        [
            "Grenada"
        ],
        [
            "Guam"
        ],
        [
            "Guatemala"
        ],
        [
            "Guernsey"
        ],
        [
            "Guinea"
        ],
        [
            "Guinea Bissau"
        ],
        [
            "Guyana"
        ],
        [
            "Haiti"
        ],
        [
            "Honduras"
        ],
        [
            "Hong Kong"
        ],
        [
            "Hungary"
        ],
        [
            "Iceland"
        ],
        [
            "India"
        ],
        [
            "Indonesia"
        ],
        [
            "Iran"
        ],
        [
            "Iraq"
        ],
        [
            "Ireland"
        ],
        [
            "Isle of Man"
        ],
        [
            "Israel"
        ],
        [
            "Italy"
        ],
        [
            "Jamaica"
        ],
        [
            "Japan"
        ],
        [
            "Jersey"
        ],
        [
            "Jordan"
        ],
        [
            "Kazakhstan"
        ],
        [
            "Kenya"
        ],
        [
            "Kuwait"
        ],
        [
            "Kyrgyz Republic"
        ],
        [
            "Laos"
        ],
        [
            "Latvia"
        ],
        [
            "Lebanon"
        ],
        [
            "Lesotho"
        ],
        [
            "Liberia"
        ],
        [
            "Libya"
        ],
        [
            "Liechtenstein"
        ],
        [
            "Lithuania"
        ],
        [
            "Luxembourg"
        ],
        [
            "Macau"
        ],
        [
            "Macedonia"
        ],
        [
            "Madagascar"
        ],
        [
            "Malawi"
        ],
        [
            "Malaysia"
        ],
        [
            "Maldives"
        ],
        [
            "Mali"
        ],
        [
            "Malta"
        ],
        [
            "Mauritania"
        ],
        [
            "Mauritius"
        ],
        [
            "Mexico"
        ],
        [
            "Moldova"
        ],
        [
            "Monaco"
        ],
        [
            "Mongolia"
        ],
        [
            "Montenegro"
        ],
        [
            "Montserrat"
        ],
        [
            "Morocco"
        ],
        [
            "Mozambique"
        ],
        [
            "Namibia"
        ],
        [
            "Nepal"
        ],
        [
            "Netherlands"
        ],
        [
            "Netherlands Antilles"
        ],
        [
            "New Caledonia"
        ],
        [
            "New Zealand"
        ],
        [
            "Nicaragua"
        ],
        [
            "Niger"
        ],
        [
            "Nigeria"
        ],
        [
            "Norway"
        ],
        [
            "Oman"
        ],
        [
            "Pakistan"
        ],
        [
            "Palestine"
        ],
        [
            "Panama"
        ],
        [
            "Papua New Guinea"
        ],
        [
            "Paraguay"
        ],
        [
            "Peru"
        ],
        [
            "Philippines"
        ],
        [
            "Poland"
        ],
        [
            "Portugal"
        ],
        [
            "Puerto Rico"
        ],
        [
            "Qatar"
        ],
        [
            "Reunion"
        ],
        [
            "Romania"
        ],
        [
            "Russia"
        ],
        [
            "Rwanda"
        ],
        [
            "Saint Pierre y Miquelon"
        ],
        [
            "Samoa"
        ],
        [
            "San Marino"
        ],
        [
            "Satellite"
        ],
        [
            "Saudi Arabia"
        ],
        [
            "Senegal"
        ],
        [
            "Serbia"
        ],
        [
            "Seychelles"
        ],
        [
            "Sierra Leone"
        ],
        [
            "Singapore"
        ],
        [
            "Slovakia"
        ],
        [
            "Slovenia"
        ],
        [
            "South Africa"
        ],
        [
            "South Korea"
        ],
        [
            "Spain"
        ],
        [
            "Sri Lanka"
        ],
        [
            "St Kitts y Nevis"
        ],
        [
            "St Lucia"
        ],
        [
            "St Vincent"
        ],
        [
            "St. Lucia"
        ],
        [
            "Sudan"
        ],
        [
            "Suriname"
        ],
        [
            "Swaziland"
        ],
        [
            "Sweden"
        ],
        [
            "Switzerland"
        ],
        [
            "Syria"
        ],
        [
            "Taiwan"
        ],
        [
            "Tajikistan"
        ],
        [
            "Tanzania"
        ],
        [
            "Thailand"
        ],
        [
            "Timor L'Este"
        ],
        [
            "Togo"
        ],
        [
            "Tonga"
        ],
        [
            "Trinidad y Tobago"
        ],
        [
            "Tunisia"
        ],
        [
            "Turkey"
        ],
        [
            "Turkmenistan"
        ],
        [
            "Turks y Caicos"
        ],
        [
            "Uganda"
        ],
        [
            "Ukraine"
        ],
        [
            "United Arab Emirates"
        ],
        [
            "United Kingdom"
        ],
        [
            "Uruguay"
        ],
        [
            "Uzbekistan"
        ],
        [
            "Venezuela"
        ],
        [
            "Vietnam"
        ],
        [
            "Virgin Islands US"
        ],
        [
            "Yemen"
        ],
        [
            "Zambia"
        ],
        [
            "Zimbabwe"
        ]
    ];
</script>

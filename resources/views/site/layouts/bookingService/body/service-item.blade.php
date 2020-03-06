<div class="col-lg-3 col-md-3 col-sm-3">
    <div class="single_room_wrapper clearfix">
        <figure class="uk-overlay uk-overlay-hover" style="height: 375px">
            <div class="room_media">
                <a href="#"><img class="img-responsive styled"
                                 src={{array_shift($item['images']['info'])['url']}} alt=""></a>
            </div>
            <div class="room_cost" style="padding-top: 3%;">
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="table-responsive">
                            <table id={{$item['id']}} class="table table-bordered
                            ">
                            <tr class="service_table">
                                <td class=""><span class="imp_table_text service-item-table">{{$item['name']}}</span>
                                </td>
                                <td class=""><span class="imp_table_text">{{$item['price']}}$</span></td>
                            </tr>
                            <tr class="service_table">
                                <td class=""><span class="imp_table_text dates1"></span></td>
                                <td class=""><span class="imp_table_text dates2"></span></td>
                            </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="uk-overlay-panel single_wrapper_details clearfix animated bounceInDown">
                <div class="border-dark-1 padding-22 clearfix single_wrapper_details_pad">
                    <p>
                        <span class="more">{{$item['description']}}</span>
                    </p>
                    <div class="single_room_cost clearfix">
                        <div class="floatright3">
                            <span data-uk-modal="{target:'#my-id',center:true}" style='cursor: pointer;color:  #000000;'
                                  class="imp_table_text"><i data-placement="top"
                                                            id={{'date'.$index}} data-index-service={{$index}} data-id-popoper=''
                                                            onclick="openPopover(this)" style="font-size: 30px;"
                                                            class={{$iconDate}}></i></span>
                            <span
                                data-index-service={{$index}} onclick="selectService(this)"
                                style='cursor: pointer;color: #000000;' class="imp_table_text is-disabled" data-id={{$item['id']}}><i
                                    style="font-size: 30px;" class="icon-ok-squared"></i></span>
                        </div>
                    </div>
                </div>
            </div>
        </figure>
    </div>
</div>

<script>
    var keyWorld = @json($data['keyWorld']);
    var service = @json($item);
    var dataReserva = @json($dataReserva);
    var services = @json($services);
    var selected = @json($selected);


    if (selected) {
        selectService($('[data-id="' + service['id'] + '"]')[0]);
        changeDateInfo();
        dataServices[service.id] = dataReserva;
    }

    $(document).ready(function () {
        for (var item in services) {
            $(function () {
                $('[data-toggle="'+item+'"]').tooltip()
            });
        }

        var showChar = 200;
        var moretext = keyWorld.read_more;
        var ellipsestext = "...";
        $('.more').each(function (index, value) {
            var content = $(this).html();

            if (content.length > showChar) {

                var c = content.substr(0, showChar);
                var h = content.substr(showChar, content.length - showChar);

                var html = c + '<span class="moreellipses">' + ellipsestext + '</span><br><br>' +
                    '<a style="padding: 2px 4px;" href="service" class="morelink btn_1_outline">' + moretext + '</a>';


                $(this).html(html);
            }


        });

        $(".morelink").click(function () {
            if ($(this).hasClass("less")) {
                $(this).removeClass("less");
                $(this).html(moretext);
            } else {
                $(this).addClass("less");
                $(this).html(lesstext);
            }
            $(this).parent().prev().toggle();
            $(this).prev().toggle();
            return false;
        });
    });


    function openPopover(elem) {
        var index_service = elem.getAttribute('data-index-service');
        service = services[index_service];
        try {
            var start = dataServices[service.id].start;
            var end = dataServices[service.id].end;
        } catch (e) {
            var start = '';
            var end = '';
        }

        var dateFields = '';
        if (elem.getAttribute('data-id-popoper') === '') {
            $(elem).removeClass('icon-calendar-empty');
            $(elem).removeClass('icon-calendar');
            $(elem).addClass(' icon-ok');
            $(elem).addClass(' isDisabled-service');

            $(elem).popover({
                content: bodyPopovers(index_service),
                html: true,
                animation: false,
                trigger: 'manual'
            });
            $(elem).on('shown.bs.popover', function (component) {
                inicialDate(index_service, $(elem));
                if (!dataServices.hasOwnProperty(service.id)) {
                    dataServices[service.id] = {
                        'id_service': service.id
                    }
                }

            });
            $(elem).popover('show');
            elem.setAttribute('data-id-popoper', elem.getAttribute('aria-describedby'));
            $('#' + elem.getAttribute('data-id-popoper')).css('left', '1px');
            $($('#' + elem.getAttribute('data-id-popoper')).children()[0]).css('left', '68%');
            $('#datepicker-service' + index_service)[0].value = (start !== undefined) ? start : keyWorld['llegada'];
            $('#datepicker1-service' + index_service)[0].value = (end !== undefined) ? end : keyWorld['salida'];
        }
        else if ($(elem).hasClass('icon-calendar') | $(elem).hasClass('icon-calendar-empty')) {
            $(elem).removeClass('icon-calendar');
            $(elem).removeClass('icon-calendar-empty');
            $(elem).addClass(' icon-ok');

            $(elem).popover('show');
            elem.setAttribute('data-id-popoper', elem.getAttribute('aria-describedby'));
            $('#' + elem.getAttribute('data-id-popoper')).css('left', '1px');
            $($('#' + elem.getAttribute('data-id-popoper')).children()[0]).css('left', '80%');
            $('#datepicker-service' + index_service)[0].value = (start !== undefined) ? start : keyWorld['llegada'];
            $('#datepicker1-service' + index_service)[0].value = (end !== undefined) ? end : keyWorld['salida'];

        } else {
            $(elem).popover('hide');
            $(elem).removeClass(' icon-ok');
            $(elem).addClass('icon-calendar');
            var parent = getParentIcon(elem);
            start = dataServices[service.id].start;
            end = dataServices[service.id].end;
            $(parent.children()[1]).removeClass('is-disabled');//Para habilitar el button de seleccionar el servicio
            try {
                changeParentClass(parent);
                changeChildInfo(elem, start + ' hasta ' + end);
            } catch (e) {
                changeDateInfoByValue(service.id, start, end);
            }

        }

    }

    function getParentIcon(elem) {
        return $(elem.parentElement.parentElement);
    }

    function changeParentClass(parent) {
        /**
         * Este metodo es para cuando se entra por la parte de los servicios en su pagina,
         *cuando no se selecciona fecha el padding toma una distancia,pero cuando se selecciona la fecha
         * para ajustar y queden en el mismo lugar los botones se modifica el padding
         */
        if (parent.hasClass('sin-dates')) {
            parent.addClass('con-dates');
            parent.removeClass('sin-dates')
        } else if (parent.hasClass('con-dates')) {
            parent.removeClass('con-dates');
            parent.addClass('sin-dates');
        }
    }

    function changeChildInfo(elem, data) {
        var childInfoDate = elem.parentElement.parentElement.querySelector('.dates');
        childInfoDate.innerText = data;
    }

    function bodyPopovers(index) {
        return '<div class="row dates-input">                 ' +
            '<div class="form-group col-lg-5 col-md-5 col-sm-5 date-inicio">\n' +
            '                    <div class="input-group border-bottom-dark-2">\n' +
            '                        <input placeholder="' + keyWorld.llegada + '" type="text" id="datepicker-service' + index + '" class="form-control form-control-sm"/>\n' +
            '                        <div class="input-group-addon"><i class="fa fa-calendar"></i></div>\n' +
            '                    </div>\n' +
            '                </div>\n' +
            '                <div class="form-group col-lg-5 col-md-5 col-sm-5 date-fin">\n' +
            '                    <div class="input-group border-bottom-dark-2">\n' +
            '                        <input placeholder="' + keyWorld.salida + '" type="text" id="datepicker1-service' + index + '" class="form-control form-control-sm"/>\n' +
            '                        <div class="input-group-addon"><i\n' +
            '                                    class="fa fa-calendar"></i></div>\n' +
            '                    </div>\n' +
            '                </div><span  style=\'cursor: pointer;color:  #000000;\'  class="imp_table_text"><i onclick="closeDateField(this)" class="icon-cancel-squared" style="font-size: 30px;" ></i></span></div>';
    }

    function inicialDate(index_service, elem) {
        return new Lightpick({
            field: document.getElementById('datepicker-service' + index_service),
            secondField: document.getElementById('datepicker1-service' + index_service),
            minDate: new Date(),
            selectForward: true,//Para obligar a seleccionar la primera fecha primero
            onSelect: function (start, end) {
                if (start !== null && end !== null) {
                    service = services[index_service];
                    dataServices[service.id] = {
                        start: start.format('D/M/Y'),
                        end: end.format('D/M/Y'),
                        'id_service': service.id,
                        'price': service.price
                    }
                    elem.removeClass('isDisabled-service');
                } else {
                    elem.addClass('isDisabled-service');
                }
            }

        });
    }

    function selectService(param) {
        var icon_select = $(param.children[0]);

        var id_service = param.getAttribute('data-id');
        var table_service = $('#' + id_service);
        if (table_service.hasClass("table-bordered")) {
            table_service.removeClass("table-bordered").addClass("table-bordered2");
            icon_select.css('color', '#72ff88');
            bookingJson.bookingService[id_service] = dataServices[id_service]
        } else {
            table_service.removeClass("table-bordered2").addClass("table-bordered");
            icon_select.css('color', '#000000');
            try {
                delete bookingJson.bookingService[id_service];
            } catch (e) {

            }
        }


    }

    function changeDateInfo() {
        document.getElementById(service['id']).querySelector('.dates1').innerText = dataReserva['start'];
        document.getElementById(service['id']).querySelector('.dates2').innerText = dataReserva['end'];

    }

    function changeDateInfoByValue(id, start, end) {
        /**
         * EN la vista de booking de los servicios para q muestre las fechas en la segunda
         * fila de la tabla debajo de la foto
         */
        document.getElementById(id).querySelector('.dates1').innerText = start;
        document.getElementById(id).querySelector('.dates2').innerText = end;

    }

    function closeDateField(elem) {

        var popoverId = elem.parentElement.parentElement.parentElement.parentElement.getAttribute('id');
        var iconPopover = $("[data-id-popoper='" + popoverId + "']");
        var index_service = iconPopover[0].getAttribute('data-index-service');
        service = services[index_service];
        iconPopover.popover('hide');
        iconPopover.removeClass(' icon-ok');
        iconPopover.addClass('icon-calendar-empty');
        iconPopover.removeClass(' isDisabled-service');
        changeDateInfoByValue(service.id, '', '');
        dataServices[service.id] = {}


    }
</script>

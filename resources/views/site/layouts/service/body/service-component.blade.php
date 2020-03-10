@foreach ($data['services'] as $item)
    @if($item['images']['info'])
        <div class="row">
            <div class="room_desc2 clearfix" onclick="">
                <div class="col-md-7">

                    <a href={{$item['images']['info'][0]['url']}} data-uk-lightbox="{group:'group1'}"
                       title={{$item['name']}}>

                        <figure class="room_pic uk-overlay-hover">
                            <div>
                                <img src={{$item['images']['info'][0]['url']}}  alt="img"
                                     class="img-responsive styled">
                                <div class="caption"></div>
                            </div>
                            <div class="uk-overlay-panel uk-overlay-background uk-overlay-icon"></div>
                            <span class="wow zoomIn"><sup>$</sup>{{$item['price']}}</span>
                        </figure>
                    </a>

                </div>
                <div class="col-md-5 room_list_desc2">
                    <h2>{{$item['name']}}</h2>
                    <span class="more">{{$item['description']}}</span>

                    <div class="row option-button sin-dates">

                        <span style='cursor: pointer;color:  #000000;'
                              class="imp_table_text dates"></span>
                        <span data-begin='' data-end=''
                                    style='cursor: pointer;color:  #000000;'
                                    class="imp_table_text"><i
                                    data-id={{$item['id']}} data-toggle="popover" data-placement="bottom"
                                    id={{'date'.$loop->index}} data-index-service={{$loop->index}} data-id-popoper=''
                                    onclick="openPopover(this)"
                                    style="font-size: 30px;"
                                    class="icon-calendar-empty only-icon"></i></span>

                        <span style='cursor: pointer;color:  #000000;'
                              class="imp_table_text"><i
                                    data-id={{$item['id']}} id={{'add'.$loop->index}} onclick="addCarrusel(this)"
                                    class=" icon-plus-squared"
                                    style="font-size: 30px;"
                                    data-index-service={{$loop->index}} ></i></span>

                    </div>
                </div>
            </div>
        </div><!-- End row room -->
    @endif
@endforeach


<script>
    var dataServices = {}

    var keyWorld = @json($data['keyWorld']);
    var services = @json($data['services']);

    $(document).ready(function () {

        var showChar = 180;  // How many characters are shown by default
        var ellipsestext = "...";
        var moretext = keyWorld.read_more;
        var lesstext = keyWorld.read_less;


        $('.more').each(function (index, value) {
            var content = $(this).html();
            var service = services[index];
            if (content.length > showChar) {

                var c = content.substr(0, showChar);
                var h = content.substr(showChar, content.length - showChar);

                var html = c + '<span class="moreellipses">' + ellipsestext + '</span><br><br><span class="morecontent"><span>' + h + '<br><br></span>' +
                    '<a href="" class="morelink btn_1_outline">' + moretext + '</a>';
                // '<a style="margin-left: 15%;" href="" class="morelink btn_1_outline">' + 'Reservar' + '</a>' +
                // '<button data-service-index='+index+' onclick="addCarrusel(this)" style="margin-left: 2%;"  class="btn_1_outline">' + 'Agregar' + '</button></span>';

                $(this).html(html);
            }
            // else{
            //     var c = content.substr(0, showChar);
            //     var html = c +'<a style="margin-left: 15%;" href="" class="morelink btn_1_outline">' + 'Reservar' + '</a>' +
            //         '<button data-service-index='+index+' onclick="addCarrusel(this)" style="margin-left: 2%;"  class="btn_1_outline">' + 'Agregar' + '</button></span>';
            //
            //     $(this).html(html);
            // }

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

    function addCarrusel(elem) {
        var icon_select = $(elem);
        var iconDate = getIconDatePopover(elem);
        if (!icon_select.hasClass('isDisabled-service') &&
            iconDate.hasClass('icon-calendar')) {
            icon_select.addClass('isDisabled-service');
            // icon_select.css('color','#72ff88');
            service = services[elem.getAttribute('data-index-service')];
            var tableCarrusel = $('.table-bordered');
            tableCarrusel.append("<tr class=\"room_table\">\n" +
                "<td class=\"col-lg-8 col-md-9\"><span class=\"imp_table_text\">" + service.name + "</span></td>\n" +
                "\n" +
                "<td class=\"col-lg-2 col-md-2\"><span class=\"imp_table_text\">" + service.price + "</span></td>\n" +
                "<td class=\"col-lg-2 col-md-1\"><span onclick=\"deleteCarrusel(this)\" data-index-service=" + elem.getAttribute('data-index-service') + "  style='cursor: pointer;' class=\"imp_table_text\"><i class=\"icon-trash-4\"></i></span></td>\n" +
                "</tr>");
            var rowHeight = tableCarrusel[0].rows[tableCarrusel[0].rows.length-1].offsetHeight;
            $('.hotel_booking3').css('height',$('.hotel_booking3')[0].offsetHeight+rowHeight);
            var bookingButton = $('#bookingServiceButton')[0];
            bookingButton.href = "bookingService?data=" + (JSON.stringify(dataServices));
        }
        else if(!iconDate.hasClass('icon-calendar')) {
            alert('Debe Seleccionar las fechas primero')
        }


    }

    function getIconDatePopover(elem) {
        return $(elem.parentElement.
        parentElement.querySelector('[data-toggle=popover]'));
    }

    function deleteCarrusel(elem) {
        $('.hotel_booking3').css('height',$('.hotel_booking3')[0].offsetHeight-elem.parentElement.parentElement.offsetHeight);
        elem.parentElement.parentElement.remove();
        var icon_select = $('#add' + elem.getAttribute('data-index-service'));
        icon_select.removeClass('isDisabled-service');



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

    function inicialDate(index_service,elem) {
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
                        'id_service': service.id
                    }
                    elem.removeClass('isDisabled-service');
                }
                else{
                    elem.addClass('isDisabled-service');
                }
            }

        });
    }

    function openPopover(elem) {
        var index_service = elem.getAttribute('data-index-service');
        service = services[index_service];
        var dateFields = '';
        var start = '';
        var end = '';
        if (elem.getAttribute('data-id-popoper') === '') {
            $(elem).removeClass('icon-calendar-empty');
            $(elem).addClass(' icon-ok');
            $(elem).addClass(' isDisabled-service');

            $(elem).popover({
                content: bodyPopovers(index_service),
                html: true,
                animation: false,
                trigger: 'manual'
            });
            $(elem).on('shown.bs.popover', function () {
                inicialDate(index_service,$(elem));
                if (!dataServices.hasOwnProperty(service.id)) {
                    dataServices[service.id] = {
                        'id_service': service.id
                    }
                }

            });
            $(elem).popover('show');
            elem.setAttribute('data-id-popoper', elem.getAttribute('aria-describedby'));
        }
        else if ($(elem).hasClass('icon-calendar') | $(elem).hasClass('icon-calendar-empty')) {
            $(elem).removeClass('icon-calendar');
            $(elem).removeClass('icon-calendar-empty');
            $(elem).addClass(' icon-ok');

            $(elem).popover('show');
            elem.setAttribute('data-id-popoper', elem.getAttribute('aria-describedby'));
            start = dataServices[service.id].start;
            end = dataServices[service.id].end;
            $('#datepicker-service' + index_service)[0].value = (start!==undefined)?start:keyWorld['llegada'];
            $('#datepicker1-service' + index_service)[0].value = (end!==undefined)?end:keyWorld['salida'];
        }
        else {
            $(elem).popover('hide');
            $(elem).removeClass(' icon-ok');
            $(elem).addClass('icon-calendar');
            var parent = getParentIcon(elem);

            changeParentClass(parent);

            start = dataServices[service.id].start;
            end = dataServices[service.id].end;
            changeChildInfo(elem, start + ' hasta ' + end);

        }

    }

    function getParentIcon(elem) {
        return $(elem.parentElement.parentElement);
    }

    function changeParentClass(parent) {
        if (parent.hasClass('sin-dates')) {
            parent.addClass('con-dates');
            parent.removeClass('sin-dates')
        }
        else if (parent.hasClass('con-dates')) {
            parent.removeClass('con-dates');
            parent.addClass('sin-dates');
        }
    }

    function changeChildInfo(elem, data) {
        var childInfoDate = elem.parentElement.parentElement.querySelector('.dates');
        childInfoDate.innerText = data;
    }

    function closeDateField(elem) {
        var popoverId = elem.parentElement.parentElement.parentElement.parentElement.getAttribute('id');
        var iconPopover = $("[data-id-popoper='" + popoverId + "']");
        iconPopover.popover('hide');
        iconPopover.removeClass(' icon-ok');
        iconPopover.addClass('icon-calendar-empty');
        iconPopover.removeClass(' isDisabled-service');
        // var parent = getParentIcon(iconPopover[0]);

        // changeParentClass(parent);
        // changeChildInfo(iconPopover[0], '');

    }
</script>


<script src="{{asset("site_assets/js/moment.min.js")}}"></script>
<script src="{{asset("site_assets/js/lightpick.js")}}"></script>

@foreach ($data['services'] as $item)
    @if($item['images']['info'])
    <div class="row">
        <div class="room_desc2 clearfix" onclick="">
            <div class="col-md-7">

                    <a href={{$item['images']['info'][0]['url']}} data-uk-lightbox="{group:'group1'}" title={{$item['name']}}>

                        <figure class="room_pic uk-overlay-hover">
                            <div><img src={{$item['images']['info'][0]['url']}}  alt="img" class="img-responsive styled"><div class="caption"></div></div>
                            <div class="uk-overlay-panel uk-overlay-background uk-overlay-icon"></div>
                            <span class="wow zoomIn"><sup>$</sup>{{$item['price']}}</span></figure>
                    </a>

            </div>
            <div  class="col-md-5 room_list_desc2">
                <h6>{{$item['name']}}</h6>
                <span class="more">{{$item['description']}}</span>
                <div class="p-2 bd-highlight">
                    <div class="form-group col-lg-11 col-md-11 col-sm-11">
                        <div class="input-group border-bottom-dark-2">
                            <input placeholder={{$data['keyWorld']['llegada']}} type="text" id="datepicker" class="form-control form-control-sm"/>
                            <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>
                    <div class="form-group col-lg-1 col-md-1 col-sm-1">
                        <div class="p-2 bd-highlight"><span onclick="addCarrusel(this)" style='cursor: pointer;color: #ed5434;' class="imp_table_text"><i class="icon-plus-squared"></i></span></div>
                        <div class="p-2 bd-highlight"><span onclick="deleteCarrusel(this)" style='cursor: pointer;color: #ed5434;' class="imp_table_text"><i class=" icon-publish"></i></span></div>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- End row room -->
    @endif
@endforeach

<script>
    new Lightpick({
        field: document.getElementById('datepicker'),
        minDate: new Date(),
        singleDate: false
    });
    var keyWorld = @json($data['keyWorld']);
    var services = @json($data['services']);
    $(document).ready(function() {


        var showChar = 300;  // How many characters are shown by default
        var ellipsestext = "...";
        var moretext = keyWorld.read_more;
        var lesstext = keyWorld.read_less;


        $('.more').each(function(index,value) {
            var content = $(this).html();
            var service = services[index];
            if(content.length > showChar) {

                var c = content.substr(0, showChar);
                var h = content.substr(showChar, content.length - showChar);

                var html = c + '<span class="moreellipses">' + ellipsestext+ '</span><br><br><span class="morecontent"><span>' + h + '<br><br></span>' +
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

        $(".morelink").click(function(){
            if($(this).hasClass("less")) {
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
        service = services[elem.getAttribute('data-service-index')];
        var tableCarrusel = $('.table-bordered');
        tableCarrusel.append("<tr class=\"room_table\">\n" +
            "<td class=\"col-lg-8 col-md-9\"><span class=\"imp_table_text\">"+service.name+"</span></td>\n" +
            "\n" +
            "<td class=\"col-lg-2 col-md-2\"><span class=\"imp_table_text\">"+service.price+"</span></td>\n" +
            "<td class=\"col-lg-2 col-md-1\"><span onclick=\"deleteCarrusel(this)\" style='cursor: pointer;' class=\"imp_table_text\"><i class=\"icon-trash-4\"></i></span></td>\n" +
            "</tr>")

    }
    function deleteCarrusel(elem) {
        elem.parentElement.parentElement.remove();
    }
</script>
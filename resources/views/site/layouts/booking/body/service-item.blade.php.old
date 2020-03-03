
<div class="col-lg-3 col-md-3 col-sm-3">
    <div class="single_room_wrapper clearfix">
        <figure class="uk-overlay uk-overlay-hover" style="height: 375px">
            <div class="room_media">
                <a href="#"><img class="img-responsive styled" src={{array_shift($item['images']['info'])['url']}} alt=""></a>
            </div>
            <div class="room_cost" style="padding-top: 3%;">
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="table-responsive">
                            <table id={{$item['id']}} class="table table-bordered">
                                <tr class="service_table">
                                    <td class=""><span class="imp_table_text service-item-table">{{$item['name']}}</span></td>
                                    <td class=""><span class="imp_table_text">{{$item['price']}}$</span></td>
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
                            <span onclick="selectService(this)" style='cursor: pointer;color: #000000;' class="imp_table_text" data-id={{$item['id']}}><i style="font-size: 30px;" class="icon-ok-squared"></i></span>
                            <span data-uk-modal="{target:'#my-id',center:true}" style='cursor: pointer;color:  #000000;' class="imp_table_text"><i style="font-size: 30px;" class=" icon-calendar-6 only-icon"></i></span>
                        </div>
                    </div>
                </div>
            </div>
        </figure>
    </div>
</div>

<script>


    $(document).ready(function() {
        var showChar = 200;
        var moretext = keyWorld.read_more;
        var ellipsestext = "...";
        $('.more').each(function(index,value) {
            var content = $(this).html();

            if(content.length > showChar) {

                var c = content.substr(0, showChar);
                var h = content.substr(showChar, content.length - showChar);

                var html = c + '<span class="moreellipses">' + ellipsestext+ '</span><br><br>' +
                    '<a style="padding: 2px 4px;" href="service" class="morelink btn_1_outline">' + moretext + '</a>';


                $(this).html(html);
            }


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
    var keyWorld = @json($data['keyWorld']);

    function selectService(param) {
        var icon_select = $(param.children[0]);

        var id_service = param.getAttribute('data-id');
        var table_service = $('#'+id_service);
        if (table_service.hasClass("table-bordered")){
            table_service.removeClass("table-bordered").addClass("table-bordered2");
            icon_select.css('color','#72ff88');
            bookingJson.bookingService[[id_service]] = {
                'begin':'fecha inicio',
                'end':'fecha fin',
                'id_service':id_service
            }
        }
        else{
            table_service.removeClass("table-bordered2").addClass("table-bordered");
            icon_select.css('color','#000000');
            delete bookingJson.bookingService[id_service];
        }


    }
</script>
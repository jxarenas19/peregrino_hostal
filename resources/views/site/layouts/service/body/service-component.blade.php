
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
            <div class="col-md-5 room_list_desc2">
                <h6>{{$item['name']}}</h6>
                <span class="more">{{$item['description']}}</span>

            </div>
        </div>
    </div><!-- End row room -->
    @endif
@endforeach

<script>
    $(document).ready(function() {
        // Configure/customize these variables.
        var showChar = 400;  // How many characters are shown by default
        var ellipsestext = "...";
        var moretext = "Show more >";
        var lesstext = "Show less";


        $('.more').each(function() {
            var content = $(this).html();
            console.log(this);
            if(content.length > showChar) {

                var c = content.substr(0, showChar);
                var h = content.substr(showChar, content.length - showChar);

                var html = c + '<span class="moreellipses">' + ellipsestext+ '&nbsp;</span><span class="morecontent"><span>' + h + '</span>&nbsp;&nbsp;<a href="" class="morelink">' + moretext + '</a></span>';

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

</script>
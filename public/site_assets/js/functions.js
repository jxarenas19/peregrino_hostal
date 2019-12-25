$(function () {


    /* Scroll to top*/
    $(window).scroll(function() {
        if($(this).scrollTop() != 0) {
            $('#toTop').fadeIn();
        } else {
            $('#toTop').fadeOut();
        }
    });
    $('#toTop').on("click",function() {
        $('body,html').animate({scrollTop:0},500);
    });
});
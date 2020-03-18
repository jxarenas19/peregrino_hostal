<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Hostal Peregrino</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @include('site.layouts.style')

</head>
<body id=@yield('id')>
@include('site.layouts.header')
    @yield('content')



@include('site.layouts.script')
    @include('site.layouts.footer')
<div id="toTop"></div><!-- Back to top button -->
</body>
</html>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(window).scroll(function() {
        if($(this).scrollTop() != 0) {
            $('#toTop').fadeIn();
        } else {
            $('#toTop').fadeOut();
        }
    });
    $('#toTop').on("click",function() {
        console.log('entro')
        $('body,html').animate({scrollTop:0},500);
    });
</script>

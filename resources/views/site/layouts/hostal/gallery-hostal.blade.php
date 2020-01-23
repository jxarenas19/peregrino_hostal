<!-- Owl carousel 2 css -->
<link rel="stylesheet" href="{{asset("site_assets/css/owl.carousel.css")}}">
<link rel="stylesheet" href="{{asset("site_assets/css/owl.theme.default.css")}}">
<script src="{{asset("site_assets/js/vendor/jquery-1.11.2.min.js")}}"></script>
<!-- owlcarousel -->
<script src="{{asset("site_assets/js/owl.carousel.min.js")}}"></script>

<div class="section_title nice_title content-center">
    <h3>GALERÍA</h3>
</div>
<div class="carousel_in">
        @foreach ($data['hostales'][0]['images']['info'] as $item)
        <figure class="room_pic uk-overlay-hover">
            <div><img style="width:750px" src={{$item['url']}} alt="img" class="img-responsive styled"><div class="caption"></div></div>
            <div class="uk-overlay-panel uk-overlay-background uk-overlay-icon"></div>
        </figure>

        @endforeach
</div>

<!-- SPECIFIC SCRIPTS -->
<script>
    $('.carousel_in').owlCarousel({
        center: true,
        items:1,
        loop:true,
        autoplay:true,

        stagePadding: 5,
        navText: [ '', '' ],
        addClassActive: true,

        responsive:{
            600:{
                items:1
            },
            1000:{
                items:2,
                nav:true,
            }
        }
    });
</script>
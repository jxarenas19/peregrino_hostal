<!-- jquery library -->
<script src="{{asset("site_assets/js/vendor/jquery-1.11.2.min.js")}}"></script>

<!-- bootstrap -->
<script src="{{asset("site_assets/js/bootstrap.min.js")}}"></script>

<!-- rev slider -->
<script src="{{asset("site_assets/js/rev-slider/rs-plugin/jquery.themepunch.plugins.min.js")}}"></script>
<script src="{{asset("site_assets/js/rev-slider/rs-plugin/jquery.themepunch.revolution.js")}}"></script>
<script src="{{asset("site_assets/js/rev-slider/rs.home.js")}}"></script>

<!-- uikit -->
<script src="{{asset("site_assets/js/uikit.min.js")}}"></script>

<!-- easing -->
<script src="{{asset("site_assets/js/jquery.easing.1.3.min.js")}}"></script>
<script src="{{asset("site_assets/js/datepicker.js")}}"></script>

<!-- scroll up -->
<script src="{{asset("site_assets/js/jquery.scrollUp.min.js")}}"></script>

<!-- owlcarousel -->
<script src="{{asset("site_assets/js/owl.carousel.min.js")}}"></script>

<!-- lightslider -->
<script src="{{asset("site_assets/js/lightslider.js")}}"></script>
<script src="{{asset("site_assets/js/functions.js")}}"></script>


<!-- wow Animation -->
<script src="{{asset("site_assets/js/wow.min.js")}}"></script>

<!--Activating WOW Animation only for modern browser-->
<!--[if !IE]><!-->
<script type="text/javascript">new WOW().init();</script>
<!--<![endif]-->

<!--Oh Yes, IE 9+ Supports animation, lets activate for IE 9+-->
<!--[if gte IE 9]>
<script type="text/javascript">new WOW().init();</script>
<![endif]-->



<!-- my js -->
<script src="{{asset("site_assets/js/main.js")}}"></script>
<script src="{{asset("personalmodal/js/bootstrap-show-modal.js")}}"></script>
<script src="{{asset("personalmodal/js/prism.js")}}"></script>





@yield('scripts')
@section('styles')
    <link rel="stylesheet" href="{{asset("site_assets/css/body.css")}}">
@stop

<!-- start welcome section -->
<section class="welcome_area">
    <div class="container">
        <div class="welcome">
            <div class="section_title nice_title content-center">
                <h3>Welcome To Hotel</h3>
            </div>
            <div class="section_description">
                <p> Semper ac dolor vitae accumsan. Cras interdum hendrerit lacinia. Phasellus accumsan urna vitae molestie interdum. Nam sed placerat libero, non eleifend dolor. </p>
            </div>
            @include('site.layouts.home.body.hostal-component')
        </div>
    </div>
</section>
<!-- end welcome section -->
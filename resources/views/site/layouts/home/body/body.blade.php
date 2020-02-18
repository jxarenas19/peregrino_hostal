@section('styles')
    <link rel="stylesheet" href="{{asset("site_assets/css/body.css")}}">
@stop

<!-- start welcome section -->
<section class="welcome_area">
    <div class="container" style="width: 100%">
        <div class="welcome">
            <div class="section_title nice_title content-center" style="padding-top: 3%;">
                <h3>{{$data['keyWorld']['welcome_hostal']}}</h3>
            </div>
        <!-- <div class="section_description">
                <p>{{$data['keyWorld']['main_description']}}</p>
            </div>-->
            <div>
                @include('site.layouts.home.body.hostal-component')
            </div>
        </div>
    </div>
</section>
<!-- end welcome section -->
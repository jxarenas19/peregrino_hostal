@section('styles')
    <link rel="stylesheet" href="{{asset("site_assets/css/body.css")}}">
@stop
<div role="tabpanel" class="tab-pane" id="booking_done">
    <div class="booking_done_area margin-top-65 margin-bottom-70">
        <div class="row">
            <div class="col-lg-7 col-md-7 col-sm-6">
                <div class="booking_done_info">
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Optio quas excepturi reprehenderit odit, accusantium, laborum natus est cumque molestias ex rem dolores harum, exercitationem quisquam tenetur qui non libero architecto.
                    </p>
                    <form role="form">
                        <div class="checkbox booking_done_confirmation">
                            <a href="#"> <i class="fa fa-check-circle"></i> {{$data['keyWorld']['message_correct']}} </a>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-5 col-md-5 col-sm-6">
                <div class="room_cost">
                    <div class="table-responsive">
                        <table class="table table-bordered">


                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>

    function goToBack(tab){
        tabBack = $('#myTab a[href="#'+tab+'"]');
        tabBack.tab('show');
    }

</script>

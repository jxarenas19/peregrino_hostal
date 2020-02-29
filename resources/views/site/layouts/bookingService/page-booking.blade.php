@extends('site.master')

@section('id', 'booking_page')
@section('content')
    @component('site.layouts.main-banner',['title'=>$data['keyWorld']['booking'],
                                                    'banner'=>'img/booking.jpg'])
    @endcomponent
    @include('site.layouts.bookingService.body.body')


@stop
<script>
    var bookingJson = {
        'generalBookingData':{},
        'bookingRoom':[],
        'bookingService':[],
        'generalData':{}
    }
    var dataServices = {}
</script>
@extends('site.master')

@section('id', 'booking_page')
@section('content')
    @component('site.layouts.main-banner',['title'=>$data['keyWorld']['booking'],
                                                    'banner'=>'img/booking.jpg'])
    @endcomponent
    @include('site.layouts.booking.body.body')


@stop
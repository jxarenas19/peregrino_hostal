@extends('site.master')

@section('id', 'booking_page')
@section('content')
    @component('site.layouts.main-banner',['title'=>$data['keyWorld']['booking'],
                                                    'banner'=>'site_assets/img/gallery-breadcrumb.jpg'])
    @endcomponent
    @include('site.layouts.booking.body.body')


@stop

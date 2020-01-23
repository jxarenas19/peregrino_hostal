@extends('site.master')

@section('id', 'accomodation_page')
@section('content')
    @component('site.layouts.main-banner',['title'=>$dataHeader['keyWorld']['servicios_agregados'],
                                                    'banner'=>$data['banner']['url']])
    @endcomponent
    @include('site.layouts.service.body.body')
@stop
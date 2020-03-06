@extends('site.master')

@section('id', 'gallery_page')
@section('content')
    @component('site.layouts.main-banner',['title'=>$data['keyWorld']['servicios_agregados'],
                                                    'banner'=>$data['banner']['url']])
    @endcomponent
    @include('site.layouts.gallery.body.body')
@stop

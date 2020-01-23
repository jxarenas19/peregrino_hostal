@extends('site.master')

@section('id', 'accomodation_page')
@section('content')
    @component('site.layouts.main-banner',['title'=>$data['hostales'][0]['name'],
                                                    'banner'=>array_shift($data['hostales'][0]['images']['mini_banner'])['url']])
    @endcomponent
    @include('site.layouts.hostal.body.body2')
    @include('site.layouts.hostal.map')
    @include('site.layouts.hostal.gallery-hostal')

@stop
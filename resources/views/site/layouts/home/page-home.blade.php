@extends('site.master')

@section('id', 'home_one')

@section('content')
    @include('site.layouts.home.main-slider')
    @include('site.layouts.home.body.body')
    @include('site.layouts.home.service.servicio')

@stop
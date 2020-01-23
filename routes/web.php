<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use Illuminate\Support\Facades\Route;

Route::get('/', 'Site\HomeController@index')->name('inicio');
Route::get('hostal', 'Site\HostalController@index')->name('hostal');
Route::get('service', 'Site\ServiceController@index')->name('service');
Route::get('booking', 'Site\BookingController@index')->name('booking');

Route::get('lang/{locale}', 'Site\HomeController@lang');
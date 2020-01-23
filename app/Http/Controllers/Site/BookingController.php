<?php

namespace App\Http\Controllers\Site;

use App\Models\Site\GeneralText;
use App\Models\Site\Hostal;
use App\Models\Site\ImagenService;
use App\Models\Site\Service;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class BookingController extends Controller
{
    public function index()
    {
        $locale = (Session::get('locale')!=null) ? Session::get('locale'): 'es';
        $languages = json_decode(cb()->findAll("locale"),true);
        $keyWorld =GeneralText::all()->first()->keyWorld($locale);

        $dataResponse = array(
            "keyWorld" => $keyWorld,
            "languages" => $languages,
            "language_active" => $locale
        );
        return view('site.layouts.booking.page-booking')->with('data', $dataResponse);
    }
}

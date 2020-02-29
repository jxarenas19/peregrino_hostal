<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Site\GeneralText;
use App\Models\Site\Hostal;
use App\Models\Site\Service;
use App\Models\Site\Social;
use Illuminate\Support\Facades\Session;

class BookingServiceController extends Controller
{
    public function index()
    {
        $dataBooking = json_decode(request('data'));
        $locale = (Session::get('locale')!=null) ? Session::get('locale'): 'es';
        $keyWorld =GeneralText::all()->first()->keyWorld($locale);
        $languages = json_decode(cb()->findAll("locale"),true);
        $redesSocial = Social::all()->where('active',1)->toArray();
        $hostals = Hostal::all()->where('active','=',true);
        $generalServices = (new Service())->generalService();
        $dataHostales = collect();
        foreach ($hostals as $hostal) {
            $dataHostales[] = $hostal->hostalMainDataToArray();
        }

        $dataResponse = array(
            "hostales" => $dataHostales->toArray(),
            "services" => $generalServices,
            "keyWorld" => $keyWorld,
            "languages" => $languages,
            "language_active" => $locale,
            "data" => $dataBooking,
            "sociales" => $redesSocial
        );

        return view('site.layouts.bookingService.page-booking')->with('data', $dataResponse);
    }
}

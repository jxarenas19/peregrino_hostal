<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Site\GeneralText;
use App\Models\Site\Hostal;
use App\Models\Site\ImagenService;
use App\Models\Site\Service;
use App\Models\Site\Social;
use Illuminate\Support\Facades\Session;

class ServiceController extends Controller
{
    public function index()
    {
        $locale = (Session::get('locale')!=null) ? Session::get('locale'): 'es';
        $languages = json_decode(cb()->findAll("locale"),true);
        $services = Service::all()->where('price','<>',null);
        $dataServices = collect();
        $keyWorld =GeneralText::all()->first()->keyWorld($locale);
        $redesSocial = Social::all()->where('active',1)->toArray();
        foreach ($services as $service) {
            $dataServices[] = $service->serviceMainDataToArray();
        }
        $hostals = Hostal::all()->where('active','=',true);
        $dataHostales = collect();
        foreach ($hostals as $hostal) {
            $dataHostales[] = $hostal->hostalHeaderData();
        }
        $bannerImg = ImagenService::all()->where(
            'estado','banner')->first();
        $dataResponse = array(
            "hostales" => $dataHostales->toArray(),
            "services" => $dataServices->toArray(),
            "keyWorld" => $keyWorld,
            "languages" => $languages,
            "language_active" => $locale,
            "banner" =>$bannerImg->toArray(),
            "sociales" => $redesSocial
        );
        return view('site.layouts.service.page-service')->with('data', $dataResponse);
    }
}

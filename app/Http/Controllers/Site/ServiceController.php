<?php

namespace App\Http\Controllers\Site;

use App\Models\Site\GeneralText;
use App\Models\Site\Hostal;
use App\Models\Site\ImagenService;
use App\Models\Site\Service;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class ServiceController extends Controller
{
    public function index()
    {
        $locale = (Session::get('locale')!=null) ? Session::get('locale'): 'es';
        $languages = json_decode(cb()->findAll("locale"),true);
        $services = Service::all();
        $dataServices = collect();
        $keyWorld =GeneralText::all()->first()->keyWorld($locale);
        foreach ($services as $service) {
            $dataServices[] = $service->serviceMainDataToArray();
        }
        $bannerImg = ImagenService::all()->where(
            'estado','banner')->first();
        $dataResponse = array(
            "services" => $dataServices->toArray(),
            "keyWorld" => $keyWorld,
            "languages" => $languages,
            "language_active" => $locale,
            "banner" =>$bannerImg->toArray()
        );
        return view('site.layouts.service.page-service')->with('data', $dataResponse);
    }
}

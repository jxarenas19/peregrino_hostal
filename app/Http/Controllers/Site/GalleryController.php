<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Site\GeneralText;
use App\Models\Site\Hostal;
use App\Models\Site\Imagen;
use App\Models\Site\ImagenHostal;
use App\Models\Site\ImagenService;
use App\Models\Site\Social;
use Illuminate\Support\Facades\Session;

class GalleryController extends Controller
{
    public function index()
    {
        $locale = (Session::get('locale')!=null) ? Session::get('locale'): 'es';
        $languages = json_decode(cb()->findAll("locale"),true);
        $imagesRoom = Imagen::all()->where('estado','=','info')->toArray();
        $imagesHostal = ImagenHostal::all()->where('estado','=','banner')->toArray();
        $keyWorld =GeneralText::all()->first()->keyWorld($locale);
        $redesSocial = Social::all()->where('active',1)->toArray();
        $hostals = Hostal::all()->where('active','=',true);
        $dataHostales = collect();
        foreach ($hostals as $hostal) {
            $dataHostales[] = $hostal->hostalHeaderData();
        }
        $bannerImg = ImagenService::all()->where(
            'estado','banner')->first();
        $dataResponse = array(
            "hostales" => $dataHostales->toArray(),
            "keyWorld" => $keyWorld,
            "languages" => $languages,
            "language_active" => $locale,
            "banner" =>$bannerImg->toArray(),
            "sociales" => $redesSocial,
            "images_hostal" => $imagesHostal,
            "images_room" => $imagesRoom
        );
        return view('site.layouts.gallery.page-gallery')->with('data', $dataResponse);
    }
}

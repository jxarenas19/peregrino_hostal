<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Site\GeneralText;
use App\Models\Site\Hostal;
use App\Models\Site\Social;
use Illuminate\Support\Facades\Session;

class HostalController extends Controller
{
    public function index()
    {
        $idHostal = request('id');
        $locale = (Session::get('locale')!=null) ? Session::get('locale'): 'es';
        $languages = json_decode(cb()->findAll("locale"),true);
        $hostal = Hostal::all()->where('id',$idHostal)->first();
        $keyWorld =GeneralText::all()->first()->keyWorld($locale);
        $redesSocial = Social::all()->where('active',1)->toArray();
        $dataResponse = array(
            "hostales" => [$hostal->hostalToArray()],
            "keyWorld" => $keyWorld,
            "languages" => $languages,
            "language_active" => $locale,
            "sociales" => $redesSocial
        );
        return view('site.layouts.hostal.page-hostal')->with('data', $dataResponse);
    }
}

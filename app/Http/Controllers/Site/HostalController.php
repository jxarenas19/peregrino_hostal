<?php

namespace App\Http\Controllers\Site;

use App\Models\Site\GeneralText;
use App\Models\Site\Hostal;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
        $dataResponse = array(
            "hostales" => [$hostal->hostalToArray()],
            "keyWorld" => $keyWorld,
            "languages" => $languages,
            "language_active" => $locale
        );
        return view('site.layouts.hostal.page-hostal')->with('data', $dataResponse);
    }
}

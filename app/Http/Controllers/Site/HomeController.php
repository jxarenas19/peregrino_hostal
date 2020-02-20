<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Site\GeneralText;
use App\Models\Site\Hostal;
use App\Models\Site\ImagenHostal;
use App\Models\Site\ImagenService;
use App\Models\Site\Service;
use App\Models\Site\Social;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    /**
     * Show the application home screen to the user.
     *
     * @return Response
     */
    public function index()
    {
        $locale = (Session::get('locale')!=null) ? Session::get('locale'): 'es';
        $hostals = Hostal::all()->where('active','=',true);
        $dataHostales = collect();
        $keyWorld =GeneralText::all()->first()->keyWorld($locale);
        $redesSocial = Social::all()->where('active',1)->toArray();
        $mainImages = ImagenHostal::all()->where('main',true)->toArray();
        $mainService = ImagenService::all()->where('main',true)
            ->where('estado','background');
        $languages = json_decode(cb()->findAll("locale"),true);
        foreach ($hostals as $hostal) {
            $dataHostales[] = $hostal->hostalMainDataToArray();
            $generalServices = (new Service())->generalService();
            #$debeSaber = (new About()) ->debeSaberToArray();
        }

        $dataResponse = array(
            "hostales" => $dataHostales->toArray(),
            "services" => $generalServices,
            "language_active" => $locale,
            "languages" => $languages,
            "keyWorld" => $keyWorld,
            "mainImages" => $mainImages,
            "sociales" => $redesSocial,
            "imageServiceUrl" => $mainService->first()->url,

        );
        return view('site.layouts.home.page-home')->with('data', $dataResponse);
    }

    /**
     * Change language site
     * @param $locale
     * @return \Illuminate\Http\RedirectResponse
     */
    public function lang($locale)
    {
        App::setLocale($locale);
        session()->put('locale', $locale);
        return redirect()->back();
    }
}

<?php

namespace App\Http\Controllers\Site;

use App\Classes\AllIcons;
use App\Http\Controllers\Controller;
use App\Models\Site\About;
use App\Models\Site\AboutCategory;
use App\Models\Site\GeneralText;
use App\Models\Site\Hostal;
use App\Models\Site\ImagenHostal;
use App\Models\Site\Room;
use App\Models\Site\RoomType;
use App\Models\Site\Service;
use App\Traits\GenericController;
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
        $hostals = Hostal::all();
        $dataHostales = collect();
        $keyWorld =GeneralText::all()->first()->keyWorld($locale);
        $mainImages = ImagenHostal::all()->where('main',true)->toArray();
        foreach ($hostals as $hostal) {
            $dataHostales[] = $hostal->hostalToArray();
            $generalServices = (new Service())->generalService();
            $debeSaber = (new About()) ->debeSaberToArray();
        }
        $languages = json_decode(cb()->findAll("locale"),true);
        $dataResponse = array(
            "hostales" => $dataHostales->toArray(),
            "services" => $generalServices,
            "debeSaber" => $debeSaber,
            "keyWorld" => $keyWorld,
            "languages" => $languages,
            "language_active" => $locale,
            "mainImages" => $mainImages
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

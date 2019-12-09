<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Site\About;
use App\Models\Site\AboutCategory;
use App\Models\Site\Hostal;
use App\Models\Site\Room;
use App\Models\Site\RoomType;
use App\Models\Site\Service;
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
        $hostals = Hostal::all();
        $dataHostales = collect();
        foreach ($hostals as $hostal) {
            $dataHostales[] = $hostal->hostalToArray();
            $generalServices = (new Service())->generalService();
            $debeSaber = (new About()) ->debeSaberToArray();
        }
        $dataResponse = array(
            "hostales" => $dataHostales->toArray(),
            "services" => $generalServices,
            "debeSaber" => $debeSaber
        );
        return view('welcome')->with('dataGeneral', $dataResponse);
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

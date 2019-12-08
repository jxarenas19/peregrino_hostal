<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Site\Hostal;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Response;

class HomeController extends Controller
{
    /**
     * Show the application home screen to the user.
     *
     * @return Response
     */
    public function index()
    {
        $hostals = Hostal::with('translations')->get()->toArray();
        return view('welcome')->with('dataGeneral', $hostals);
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

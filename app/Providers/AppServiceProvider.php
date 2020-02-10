<?php

namespace App\Providers;

use App\Models\Site\GeneralText;
use App\Models\Site\Hostal;
use App\Models\Site\Social;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $locale = (Session::get('locale')!=null) ? Session::get('locale'): 'es';
        $keyWorld =GeneralText::all()->first()->keyWorld($locale);
        $languages = json_decode(cb()->findAll("locale"),true);
        $redesSocial = Social::all()->where('active',1)->toArray();
        $hostals = Hostal::all();
        $dataHostales = collect();
        foreach ($hostals as $hostal) {
            $dataHostales[] = $hostal->hostalHeaderData();
        }
        $dataResponse = array(
            "hostales" => $dataHostales->toArray(),
            "keyWorld" => $keyWorld,
            "language_active" => $locale,
            "languages" => $languages,
            "sociales" => $redesSocial
        );
        View::share('dataHeader', $dataResponse);
    }
}

<?php

namespace App\Providers;

use App\Models\Site\GeneralText;
use App\Models\Site\Hostal;
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

        $hostals = Hostal::all();
        $dataHostales = collect();
        foreach ($hostals as $hostal) {
            $dataHostales[] = $hostal->hostalHeaderData();
        }
        $dataResponse = array(
            "hostales" => $dataHostales->toArray(),
            "keyWorld" => $keyWorld,
            "language_active" => $locale,
            "languages" => $languages
        );
        View::share('dataHeader', $dataResponse);
    }
}

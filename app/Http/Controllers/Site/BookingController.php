<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Site\GeneralText;
use App\Models\Site\Hostal;
use App\Models\Site\Service;
use App\Models\Site\Social;
use Illuminate\Support\Facades\Session;

class BookingController extends Controller
{
    public function index()
    {
        $dataBooking = json_decode(request('data'));
        $locale = (Session::get('locale')!=null) ? Session::get('locale'): 'es';
        $keyWorld =GeneralText::all()->first()->keyWorld($locale);
        $languages = json_decode(cb()->findAll("locale"),true);
        $redesSocial = Social::all()->where('active',1)->toArray();
        $hostals = Hostal::all()->where('active','=',true);
        if ($dataBooking){
            $hostalsBooking = Hostal::all()->where('id',$dataBooking->hostal);
            $dataBooking = array(
                'room' => $dataBooking->rooms,
                'hostal' => $dataBooking->hostal,
                'huespedes' => $dataBooking->huespedes,
                'begin' => $dataBooking->begin,
                'end' => $dataBooking->end,
                'diffInDays' => $dataBooking->diffInDays,
            );


        }
        else{
            $hostalsBooking = Hostal::all()->where('active','=',true);
        }
        $dataHostalesBooking = collect();
        foreach ($hostalsBooking as $hostal) {
            $dataHostalesBooking[] = $hostal->hostalMainDataToArray();
            $generalServices = (new Service())->generalService();
            #$debeSaber = (new About()) ->debeSaberToArray();
        }
        $dataHostales = collect();
        foreach ($hostals as $hostal) {
            $dataHostales[] = $hostal->hostalMainDataToArray();
        }


        $dataResponse = array(
            "hostalesBooking" => $dataHostalesBooking->toArray(),
            "hostales" => $dataHostales->toArray(),
            "services" => $generalServices,
            "keyWorld" => $keyWorld,
            "languages" => $languages,
            "language_active" => $locale,
            "data" => $dataBooking,
            "sociales" => $redesSocial
        );

        return view('site.layouts.booking.page-booking')->with('data', $dataResponse);
    }
}

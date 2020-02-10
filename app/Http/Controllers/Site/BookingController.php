<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Site\GeneralText;
use App\Models\Site\Hostal;
use App\Models\Site\Service;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;

class BookingController extends Controller
{
    public function index()
    {
        $dataBooking = json_decode(request('data'));

        $locale = (Session::get('locale')!=null) ? Session::get('locale'): 'es';
        $languages = json_decode(cb()->findAll("locale"),true);
        $keyWorld =GeneralText::all()->first()->keyWorld($locale);
        if ($dataBooking){
            $hostals = Hostal::all()->where('id',$dataBooking->hostal);
            $begin =new Carbon($dataBooking->begin);
            $end =new Carbon($dataBooking->end);
            $diasDiferencia = $end->diffInDays($begin);
            $dataBooking = array(
                'room' => $dataBooking->rooms,
                'hostal' => $dataBooking->hostal,
                'huespedes' => $dataBooking->huespedes,
                'begin' => $dataBooking->begin,
                'end' => $dataBooking->end,
                'diffInDays' => $diasDiferencia,
            );


        }
        else{
            $hostals = Hostal::all();
        }
        $dataHostales = collect();
        foreach ($hostals as $hostal) {
            $dataHostales[] = $hostal->hostalMainDataToArray();
            $generalServices = (new Service())->generalService();
            #$debeSaber = (new About()) ->debeSaberToArray();
        }



        $dataResponse = array(
            "hostales" => $dataHostales->toArray(),
            "services" => $generalServices,
            "keyWorld" => $keyWorld,
            "languages" => $languages,
            "language_active" => $locale,
            "data" => $dataBooking
        );
        return view('site.layouts.booking.page-booking')->with('data', $dataResponse);
    }
}

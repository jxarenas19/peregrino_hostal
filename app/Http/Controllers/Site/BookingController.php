<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Site\GeneralText;
use App\Models\Site\Hostal;
use App\Models\Site\Service;
use App\Models\Site\Social;
use crocodicstudio\crudbooster\helpers\MailHelper;
use Illuminate\Support\Facades\Session;

//use PHPMailer\PHPMailer\PHPMailer;
//use PHPMailer\PHPMailer\Exception;
//require 'PHPMailer-master/src/Exception.php';
//require 'PHPMailer-master/src/PHPMailer.php';
//require 'PHPMailer-master/src/SMTP.php';

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
            $dataHostalesBooking[] = $hostal->hostalDataToArray();
            $generalServices = (new Service())->generalService();
            #$debeSaber = (new About()) ->debeSaberToArray();
        }
        $dataHostales = collect();
        foreach ($hostals as $hostal) {
            $dataHostales[] = $hostal->hostalDataToArray();
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

    public function reservar(){
        $data = json_decode(request('informacion'));
        // Send mail script
        $mail = new MailHelper();

        // First param is for send mail address, second param is for sender name
        $mail->sender("jxarenas21990@gmail.com", "Ferry");

        $mail->to("jxarenas21990@gmail.com");
        $mail->subject("Welcome to CRUDBooster");
        $dataMail = $this->findBodyData($data);

        $mail->content($this->createBodyMail($dataMail));



        // Send email
//       $mail->send();
        $response = ['success' => True, 'data' => $data];
        return response()->json($response, 200);

    }
    public function findBodyData($data){
        $total_adults = 0;
        $total_childrens = 0;
        foreach ($data->bookingRoom as $item) {

            $total_adults+=(int)$item->adults;
            $total_childrens+=(int)$item->childrens;
        }

        $hostal = Hostal::all()->where('id','=',
            $data->generalBookingData->hostal);

       return array(
            'email'=> $data->generalData->mail,
            'adults'=> $total_adults,
            'childrens'=> $total_childrens,
            'name' => $data->generalData->nombre,
            'country' => $data->generalData->nacionalidad,
            'pasaporte' => 'numero pasaporte',
            'genero' => 'M',
            'fecha_nacimiento' => '21/06/1990',
            'hostal'=>$hostal->first()->name,
            'tipoRoom'=> 'Doble'
        );
    }

    public function createBodyMail($data){
        $body = 'No. adultos:'.$data['adults'].'\n';
        $body .= 'No. niños:'.$data['childrens'].'\n';
        return $body;
    }

}

<?php

namespace App\Models\Site;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Service extends Model implements TranslatableContract
{
    use Translatable;
    protected $table = 'hp_services';
    public $translatedAttributes = ['name', 'description'];

    /**Devuelve el hostal relacionado con el servicio
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function hostal()
    {
        return $this->belongsTo(Hostal::class,'hostal_id');
    }

    public function generalService()
    {
        $free = Service::where('hostal_id','=',null)
            ->where('price','=',null)->get();
        $pay = Service::where('hostal_id','=',null)
            ->where('price','!=',null)->get();
        $freeResponse = collect();
        $payResponse = collect();
        foreach ($free as $item){
            $data = array(
                "name" => $item->name,
                "description" => $item->description,
                "price" => $item->price,
            );
            $freeResponse[] = $data;
        }
        foreach ($pay as $item){
            $data = array(
                "name" => $item->name,
                "description" => $item->description,
                "price" => $item->price,
            );
            $payResponse[] = $data;
        }
        return array(
            "freeServices" => $freeResponse->toArray(),
            "payServices" => $payResponse->toArray(),
        );
    }


}

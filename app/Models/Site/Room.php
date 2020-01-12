<?php

namespace App\Models\Site;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Room extends Model implements TranslatableContract
{
    use Translatable;
    protected $table = 'hp_rooms';
    public $translatedAttributes = ['name', 'description'];

    /**Devuelve el hostal relacionado con la habitacion
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function hostal()
    {
        return $this->belongsTo(Hostal::class,'hostal_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function typeRoom()
    {
        return $this->belongsTo(RoomType::class,'type_room_id');
    }

    /**Devuelve los precios de la habitacion
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function prices()
    {
        return $this->hasMany(Price::class,'room_id');
    }

    public function pricesToRoomArray()
    {
        $prices = $this->prices;
        $pricesResponse = collect();
        foreach ($prices as $price){
            $begin =new Carbon($price->season->fechas->getAttribute('begin'));
            $end =new Carbon($price->season->fechas->getAttribute('end'));
            $array = array(
                "temporada" =>$price->season->getAttribute('name'),
                "inicio" =>$begin->format('d-m'),
                "fin" =>$end->format('d-m'),
                "precio" => $price->toArray()['price'],
                "images" => $this->imagesToHostalArray(),
            );
            $pricesResponse[] = $array;
        }
        return $pricesResponse;
    }
    /**
     * Obtiene todas las imagenes asociadas a un hostal
     */
    public function images()
    {
        return $this->hasMany(Imagen::class, 'room_id');
    }

    /**Devuelve un array con cada una de las fotos y sus atributos
     * @param $id_hostal
     * @return array
     */
    public function imagesToHostalArray()
    {
        return array(
            'info'=> $this->images->where('estado','info')->toArray()
        );

    }
    /**
     * Devuelve las imagenes de de info del hostal
     */
    public function imagesInfo()
    {
        return array(
            'info'=> $this->images->where('estado','info')->toArray()
        );
    }
    public function conforts()
    {
        return $this->belongsToMany(Confort::class, 'hp_conforts_rooms');
    }
}

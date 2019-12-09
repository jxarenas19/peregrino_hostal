<?php

namespace App\Models\Site;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

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
            $array = array(
                "temporada" =>$price->season->getAttribute('name'),
                "inicio" =>$price->season->fechas->getAttribute('begin'),
                "fin" =>$price->season->fechas->getAttribute('end'),
                "precio" => $price->toArray()['price']
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
     * @return listado de images
     */
    public function imagesToHostalArray()
    {
        return $this->images->toArray();

    }
    public function conforts()
    {
        return $this->belongsToMany(Confort::class, 'hp_conforts_rooms');
    }
}

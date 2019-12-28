<?php

namespace App\Models\Site;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Hostal extends Model implements TranslatableContract
{
    use Translatable;

    public $translatedAttributes = ['name', 'mini_description', 'description', 'address'];
    protected $table = 'hp_hostales';
    protected $appends = ['full_name'];

    public function getFullnameAttribute()
    {
        return $this->name . ' ' . $this->name;
    }

    /**
     * Obtiene todas las imagenes asociadas a un hostal
     */
    public function images()
    {
        return $this->hasMany(ImagenHostal::class, 'hostal_id');
    }

    /**Devuelve un array con cada una de las fotos y sus atributos
     * @param $id_hostal
     * @return array
     */
    public function imagesToHostalArray()
    {
        return array(
            'banner'=> $this->images->where('estado','banner')->toArray(),
            'info'=> $this->images->where('estado','info')->toArray(),
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
        /**
     * Devuelve las imagenes del banner del hostal
     */
    public function imagesBanner()
    {
        return array(
            'banner'=> $this->images->where('estado','banner')->toArray()
        );
    }
    /** Collection de habitaciones relacionadas con el hostal
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function rooms()
    {
        return $this->hasMany(Room::class, 'hostal_id');
    }

    /**
     * Devuelve un listado de todas las facilidades de las habitaciones
     */
    public function rooms_conforts(){
        $rooms = $this->hasMany(Room::class, 'hostal_id')->get('id');
        $conforts = array();
        foreach ($rooms as $item){
            $conforts = array_merge($conforts,
                $item->conforts()->get()->toArray());

        }
        return $conforts;
    }
    /**Metodo encargado de retornar un array con los datos en español
     * de las habitaciones del hostal
     * @return array|\Illuminate\Support\Collection
     */
    public function roomsToHostalArray()
    {
        $rooms = $this->rooms;
        $roomResponse = collect();
        foreach ($rooms as $room){
            $typeRoom = $room->typeRoom->toArray();
            $data = array(
                "id" => $room->getAttribute('id'),
                "name" => $room->getAttribute('name'),
                "tipoRoom" => $typeRoom['name'],
                "precio" => $room->pricesToRoomArray()->toArray(),
                "hostal" => $room->hostal->attributesToArray()['name'],
                "descripcion" => ($room->getAttribute('description')!=null)?
                    $room->getAttribute('description'): $typeRoom['description'],
            );
            $roomResponse[] = $data;
        }
        return $roomResponse;
    }

    /**Datos del hostal en español
     * @return array
     */
    public function hostalToArray()
    {
        $data = array(
            "id" => $this->getAttribute('id'),
            "name" => $this->getAttribute('name'),
            "description" => $this->getAttribute('description'),
            "mini_description" => $this->getAttribute('mini_description'),
            "address" => $this->getAttribute('address'),
            "email" => $this->getAttribute('email'),
            "latitude" => $this->getAttribute('latitude'),
            "length" => $this->getAttribute('length'),
            "rooms" => $this->roomsToHostalArray()->toArray(),
            "services" => $this->servicesToHostalArray(),
            "images" => $this->imagesToHostalArray(),
            "conforts" => $this->rooms_conforts()
        );
        return $data;
    }
    public function hostalMainDataToArray(){
        $data = array(
            "id" => $this->getAttribute('id'),
            "name" => $this->getAttribute('name'),
            "mini_description" => $this->getAttribute('mini_description'),
            "address" => $this->getAttribute('address'),
            "latitude" => $this->getAttribute('latitude'),
            "length" => $this->getAttribute('length'),
            "services" => $this->servicesToHostalArray(),
            "rooms" => $this->roomsToHostalArray()->toArray(),
            "images" => $this->imagesInfo(),
            "conforts" => $this->rooms_conforts()

        );
        return $data;
    }
    public function hostalHeaderData()
    {
        return array(
            "id" => $this->getAttribute('id'),
            "name" => $this->getAttribute('name'),
        );
    }
    /**Devuelve los servicios asociados al hostal
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function services()
    {
        return $this->hasMany(Service::class,'hostal_id');
    }

    public function servicesToHostalArray()
    {
        $services = $this->services;
        $serviceResponse = collect();
        foreach ($services as $service){
            $data = array(
                "titulo" => $service->getAttribute('titulo'),
                "descripcion" => $service->getAttribute('descripcion'),
                "precio" => $service->getAttribute('precio'),
            );
            $serviceResponse[] = $data;
        }
        return $serviceResponse->toArray();
    }
    public function politicas()
    {
        return $this->belongsToMany(Politicas::class,
            'hp_politicas_hostales','hostal_id','politica_id');
    }
}

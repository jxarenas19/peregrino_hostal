<?php

namespace App\Models\Site;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

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
            'banner' => $this->images->where('estado', 'banner')->toArray(),
            'info' => $this->images->where('estado', 'info')->toArray(),
            'mini_banner' => $this->images->where('estado', 'mini_banner')->toArray(),
        );

    }

    /**
     * Devuelve las imagenes de de info del hostal
     */
    public function imagesInfo()
    {
        return array(
            'info' => $this->images->where('estado', 'info')->toArray()
        );
    }
    /**
     * Devuelve las imagenes de de info del hostal
     */
    public function imagesInfoMain()
    {
        return array(
            'info' => $this->images->where('estado', 'info')->where('main',true)->toArray()
        );
    }
    /**
     * Devuelve las imagenes del mini banner del hostal
     */
    public function imagesBanner()
    {
        return array(
            'banner' => $this->images->where('estado', 'banner')->toArray()
        );
    }

    /**
     * Devuelve las imagenes del banner del hostal
     */
    public function imagesMiniBanner()
    {
        return array(
            'mini_banner' => $this->images->where('estado', 'mini_banner')->toArray()
        );
    }

    public function imagesRoomByHostalInfo()
    {
        return Imagen::all()->where('estado','=','info')->toArray();
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
    public function rooms_conforts()
    {
        $rooms = $this->hasMany(Room::class, 'hostal_id')->get('id');
        $confortsTemp = array();
        foreach ($rooms as $item) {
            $confortsTemp = array_merge($confortsTemp,
                $item->conforts()->get()->toArray());
        }
        $conforts = array();
        $exist_icon = array();
        $cont = 0;
        foreach ($confortsTemp as $elem) {
            if (!in_array($elem['icon'], $exist_icon) and $cont < 7) {
                $conforts[] = $elem;
                $exist_icon[] = $elem['icon'];
                $cont = +1;
            }
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
        $today = Carbon::today()->toDate()->format('Y-m-d');
        $season_id = DateSeason::all()->first()->season_id;
        foreach ($rooms as $room) {
            $priceActual = $room->prices()
                ->where('season_id', $season_id)->first()->price;
            $typeRoom = $room->typeRoom->toArray();
            $data = array(
                "id" => $room->getAttribute('id'),
                "name" => $room->getAttribute('name'),
                "countPeople" => $room->getAttribute('count_people'),
                "tipoRoom" => $typeRoom['name'],
                "precio" => $room->pricesToRoomArray()->toArray(),
                "hostal" => $room->hostal->attributesToArray()['name'],
                "images" => $room->imagesToHostalArray(),
                "descripcion" => ($room->getAttribute('description') != null) ?
                    $room->getAttribute('description') : $typeRoom['description'],
                "priceActual" => $priceActual,
                "conforts" => $room->conforts->toArray(),
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

    public function hostalDataToArray()
    {
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
    public function hostalMainDataToArray()
    {
        $data = array(
            "id" => $this->getAttribute('id'),
            "name" => $this->getAttribute('name'),
            "mini_description" => $this->getAttribute('mini_description'),
            "address" => $this->getAttribute('address'),
            "latitude" => $this->getAttribute('latitude'),
            "length" => $this->getAttribute('length'),
            "services" => $this->servicesToHostalArray(),
            "rooms" => $this->roomsToHostalArray()->toArray(),
            "images" => $this->imagesInfoMain(),
            "conforts" => $this->rooms_conforts()

        );
        return $data;
    }
    public function hostalHeaderData()
    {
        return array(
            "id" => $this->getAttribute('id'),
            "name" => $this->getAttribute('name'),
            "address" => $this->getAttribute('address'),
            "images_info" => $this->imagesInfo(),
            "images_banner" => $this->imagesBanner(),
            "images_room" => $this->imagesRoomByHostalInfo(),

        );
    }

    /**Devuelve los servicios asociados al hostal
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function services()
    {
        return $this->hasMany(Service::class, 'hostal_id');
    }

    public function servicesToHostalArray()
    {
        $services = $this->services;
        $serviceResponse = collect();
        foreach ($services as $service) {
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
            'hp_politicas_hostales', 'hostal_id', 'politica_id');
    }
}

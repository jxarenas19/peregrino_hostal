<?php

namespace App\Models\Site;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class RoomType extends Model implements TranslatableContract
{
    use Translatable;

    public $translatedAttributes = ['name', 'description'];
    protected $translationForeignKey = 'type_room_id';
    protected $table = 'hp_types_room';

    public function rooms()
    {
        return $this->hasMany(Room::class, 'type_room_id');
    }
}

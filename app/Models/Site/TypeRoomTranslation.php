<?php

namespace App\Models\Site;

use Illuminate\Database\Eloquent\Model;

class TypeRoomTranslation extends Model
{
    public $timestamps = false;
    protected $table = 'hp_types_room_translations';
    protected $fillable = ['name', 'description'];
}

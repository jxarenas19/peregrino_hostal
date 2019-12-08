<?php

namespace App\Models\Site;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Room extends Model implements TranslatableContract
{
    use Translatable;

    public $translatedAttributes = ['name', 'description'];
    protected $table = 'hp_rooms';

    public function conforts()
    {
        return $this->belongsToMany(Confort::class, 'hp_conforts_rooms');
    }
}

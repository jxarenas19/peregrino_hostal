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
}

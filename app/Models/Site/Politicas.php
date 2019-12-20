<?php

namespace App\Models\Site;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Politicas extends Model implements TranslatableContract
{
    use Translatable;
    protected $table = 'hp_politicas';
    public $translatedAttributes = ['name'];
}

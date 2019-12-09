<?php

namespace App\Models\Site;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class AboutCategory extends Model implements TranslatableContract
{
    use Translatable;
    protected $table = 'hp_category_about';
    protected $translationForeignKey = 'category_id';
    public $translatedAttributes = ['name'];
}

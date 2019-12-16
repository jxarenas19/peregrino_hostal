<?php

namespace App\Models\Site;

use Illuminate\Database\Eloquent\Model;

class ImageHostalTranslation extends Model
{
    public $timestamps = false;
    protected $table = 'hp_images_hostal_translations';
    protected $fillable = ['name','description'];
}

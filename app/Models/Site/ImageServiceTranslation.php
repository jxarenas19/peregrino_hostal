<?php

namespace App\Models\Site;

use Illuminate\Database\Eloquent\Model;

class ImageServiceTranslation extends Model
{
    public $timestamps = false;
    protected $table = 'hp_images_service_translations';
    protected $fillable = ['name','description'];
}

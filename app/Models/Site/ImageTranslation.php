<?php

namespace App\Models\Site;

use Illuminate\Database\Eloquent\Model;

class ImageTranslation extends Model
{
    public $timestamps = false;
    protected $table = 'hp_images_translations';
    protected $fillable = ['name','description'];
}

<?php

namespace App\Models\Site;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class ImagenService extends Model implements TranslatableContract
{
    use Translatable;
    protected $table = 'hp_images_service';
    public $translatedAttributes = ['name','description'];

    /**
     * Get the post that owns the comment.
     */

    public function service()

    {

        return $this->belongsTo(Service::class);

    }
}

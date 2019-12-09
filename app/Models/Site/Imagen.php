<?php

namespace App\Models\Site;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Imagen extends Model implements TranslatableContract
{
    use Translatable;
    protected $table = 'hp_images';
    public $translatedAttributes = ['name','description'];

    /**
     * Get the post that owns the comment.
     */

    public function hostal()

    {

        return $this->belongsTo(Hostal::class);

    }
}

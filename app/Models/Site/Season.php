<?php

namespace App\Models\Site;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Season extends Model implements TranslatableContract
{
    use Translatable;
    protected $table = 'hp_seasons';
    public $translatedAttributes = ['name'];

    /**Devuelve las fechas relacionadas con la temporada
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function fechas()
    {
        return $this->hasOne(DateSeason::class, 'season_id');
    }
}

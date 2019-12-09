<?php

namespace App\Models\Site;

use Illuminate\Database\Eloquent\Model;

class DateSeason extends Model
{
    protected $table = 'hp_seasons_date';

    /**Devuelve la temporada relacionada con las fechas
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function temporada()
    {
        return $this->belongsTo(Hostal::class,'season_id');
    }
}

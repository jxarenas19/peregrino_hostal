<?php

namespace App\Models\Site;

use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    protected $table = 'hp_prices';

    /**Devuelve la habitacion relacionada con el precio
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function room()
    {
        return $this->belongsTo(Room::class,'room_id');
    }

    /** Temporada del asociada al precio
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function season()
    {
        return $this->belongsTo(Season::class, 'season_id');
    }
}

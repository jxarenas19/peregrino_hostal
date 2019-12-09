<?php

namespace App\Models\Site;

use Illuminate\Database\Eloquent\Model;

class SeasonTranslation extends Model
{
    public $timestamps = false;
    protected $table = 'hp_seasons_translations';
    protected $fillable = ['name'];
}

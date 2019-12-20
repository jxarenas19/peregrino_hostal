<?php

namespace App\Models\Site;

use Illuminate\Database\Eloquent\Model;

class PoliticasTranslation extends Model
{
    public $timestamps = false;
    protected $table = 'hp_politicas_translations';
    protected $fillable = ['name'];
}

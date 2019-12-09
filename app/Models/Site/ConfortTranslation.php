<?php

namespace App\Models\Site;

use Illuminate\Database\Eloquent\Model;

class ConfortTranslation extends Model
{
    public $timestamps = false;
    protected $table = 'hp_conforts_translations';
    protected $fillable = ['name'];
}

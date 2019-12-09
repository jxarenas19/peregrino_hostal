<?php

namespace App\Models\Site;

use Illuminate\Database\Eloquent\Model;

class AboutTranslation extends Model
{
    public $timestamps = false;
    protected $table = 'hp_about_translations';
    protected $fillable = ['name','description'];
}

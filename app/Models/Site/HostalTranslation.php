<?php

namespace App\Models\Site;

use Illuminate\Database\Eloquent\Model;

class HostalTranslation extends Model
{
    public $timestamps = false;
    protected $table = 'hp_hostales_translations';
    protected $fillable = ['name', 'mini_description', 'description', 'address'];
}

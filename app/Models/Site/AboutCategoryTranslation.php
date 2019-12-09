<?php

namespace App\Models\Site;

use Illuminate\Database\Eloquent\Model;

class AboutCategoryTranslation extends Model
{
    public $timestamps = false;
    protected $table = 'hp_category_about_translations';
    protected $fillable = ['name'];
}

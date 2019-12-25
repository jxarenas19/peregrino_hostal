<?php

namespace App\Models\Site;


use Illuminate\Database\Eloquent\Model;

class GeneralText extends Model
{
    protected $table = 'hp_general_text';


    /**Devuelve las palabras claces del idioma actual
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function keyWorld(String $locale)
    {
        return json_decode($this->json,true)[$locale];
    }
}

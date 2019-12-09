<?php

namespace App\Models\Site;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class About extends Model implements TranslatableContract
{
    use Translatable;
    protected $table = 'hp_about';
    public $translatedAttributes = ['name','description'];

    /**Devuelve la categoria asociada
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(AboutCategory::class,'category_id');
    }

    public function debeSaberToArray()
    {
        $categorys = AboutCategory::all();
        $arrayResponse = array();
        foreach ($categorys as $category){
            $debeSaber = $this->where('category_id','=',$category->id)
                ->get()->toArray();
            foreach ($debeSaber as $item){
                $arrayResponse[$category->name][] = array(
                    "name" =>$item['name']!='Null'?$item['name']:'',
                    "description" =>$item['description'],
                );
            }
        }
        return $arrayResponse;
    }
}

<?php


namespace App\Classes;

use Illuminate\Support\Facades\DB;

/**
 * Class Util
 * Clase encargada de manejar lo relacionado con guardar los datos
 * de cada lenguaje para cada tabla
 * @package App\Classes
 */
class UtilSave
{
    public function __construct($data, $dbTranslation)
    {
        $this->data = $data;
        $this->locales = cb()->findAll("locale");
        $this->dbTranslation = $dbTranslation;


    }

    /**Metodo encargado de devolver array con la informacion de cada
     * idioma configurado en el sistema
     * @return array
     */
    public function findLanguageData()
    {
        $data = $this->data;
        $dictTranslation = array();

        foreach (array_keys($data) as $item) {
            $splitAttribute = explode('-', $item);
            if (count($splitAttribute) != 1 and $splitAttribute[1] != 'at') {
                if (cb()->findAll("locale")
                    ->where('code', '=', end($splitAttribute))->first()) {
                    $attribute = $splitAttribute[0];
                    $lenguage = end($splitAttribute);
                    $field = array("$attribute" => $data[$item]);
                    if (array_key_exists($lenguage, $dictTranslation)) {
                        $dictTranslation[$lenguage][$attribute] = $data[$item];
                    } else {
                        $dictTranslation[$lenguage] = $field;
                    }

                }
            }
        }
        return $dictTranslation;
    }

    public function deleteExtraField($data)
    {
        foreach (array_keys($data) as $item) {
            $splitAttribute = explode('-', $item);
            if (count($splitAttribute) > 1
                and end($splitAttribute) != 'visual') {
                unset($data[$item]);
            } elseif ($item == null) {
                unset($data[$item]);
            } elseif (explode('-', $data[$item])[0] == 'confort'
                or explode('-', $data[$item])[0] == 'precios'
                or explode('-', $data[$item])[0] == 'politica') {
                unset($data[$item]);
            }
        }
        return $data;
    }

    public function saveTranslations($last_insert_id)
    {
        $columnsName = collect(DB::table($this->dbTranslation)
            ->getConnection()
            ->getSchemaBuilder()
            ->getColumnListing($this->dbTranslation));
        $columnsName->pull($columnsName->search('id'));
        $fieldRelation = $columnsName[1];
        foreach ($GLOBALS['lenguageData'] as $key => $value) {
            $value[$fieldRelation] = $last_insert_id;
            $value['locale'] = $key;
            $value['icon'] = cb()->find("locale", ["code" => $value["locale"]])->icon;
            if ($value["id"] != null) {
                DB::table($this->dbTranslation)
                    ->where("id", "=", $value["id"])->update($value);
            } else {
                DB::table($this->dbTranslation)->insertGetId($value);
            }
        }
    }

    public function addDefaultValueData($data)
    {
        $trans = $GLOBALS['lenguageData']['es'];
        foreach ($data as $key => $ok) {
            $splitAttribute = explode('-', $key);
            if (end($splitAttribute) == 'visual') {
                $data[$key] = $trans[$splitAttribute[0]];
            }
        }
        return $data;
    }

    public function findConfortData()
    {
        $data = $this->data;
        $arrayConforts = array();
        foreach ($data as $item) {
            $splitAttribute = explode('-', $item);
            if ($splitAttribute[0] === 'confort') {
                $arrayConforts[] = $splitAttribute[1];
            }
        }
        return $arrayConforts;
    }
    public function findPoliticasData()
    {
        $data = $this->data;
        $arrayPoliticas = array();
        foreach ($data as $item) {
            $splitAttribute = explode('-', $item);
            if ($splitAttribute[0] === 'politica') {
                $arrayPoliticas[] = $splitAttribute[1];
            }
        }
        return $arrayPoliticas;
    }
    public function findPriceData()
    {
        try{
            $data = $this->data["precios-at"];
            return json_decode($data);
        }
        catch (\Exception $error){
            return [];
        }
    }
    public function saveConforts($last_insert_id)
    {
        foreach ($GLOBALS['confortData'] as $item) {
            DB::table('hp_conforts_rooms')->insertGetId(array(
                'confort_id' => $item,
                'room_id' => $last_insert_id,
            ));
        }
    }
    public function savePoliticas($last_insert_id)
    {
        foreach ($GLOBALS['politicaData'] as $item) {
            DB::table('hp_politicas_hostales')->insertGetId(array(
                'politica_id' => $item,
                'hostal_id' => $last_insert_id,
            ));
        }
    }
    public function savePrices($last_insert_id)
    {
        if ($GLOBALS['priceData']!=null){
        $hostal_id= cb()->find("hp_rooms",["id"=>$last_insert_id])->hostal_id;
        foreach ($GLOBALS['priceData'] as $key => $item) {
            if (cb()->getCurrentMethod()=='postAddSave'){
                DB::table('hp_prices')->insertGetId(array(
                    'price' => $item,
                    'season_id' => $key,
                    'hostal_id' => $hostal_id,
                    'room_id' => $last_insert_id,
                    "created_at"=>date("Y-m-d H:i:s"),
                    "updated_at"=>date("Y-m-d H:i:s")
                ));
            }
            elseif (cb()->getCurrentMethod()=='postEditSave'){
                $elem = DB::table('hp_prices')
                    ->where("room_id", "=", $last_insert_id)
                    ->where("season_id", "=", $key);
                if ($elem->exists()) {
                    $elem->update(['price'=> $item]);
                }
                else{
                    DB::table('hp_prices')->insertGetId(array(
                        'price' => $item,
                        'season_id' => $key,
                        'hostal_id' => $hostal_id,
                        'room_id' => $last_insert_id,
                        "created_at"=>date("Y-m-d H:i:s"),
                        "updated_at"=>date("Y-m-d H:i:s")
                    ));
                }
            }

        }
        }
    }
    public function deleteAllConforts($id)
    {
        DB::table('hp_conforts_rooms')
            ->where('room_id', '=', $id)->delete();
    }
    public function adjustImageResolution($url,$type){
        $width = 800;
        $heigth = 480;
        switch ($type){
            case 'banner':
                $width = 1970;
                $heigth = 736;
                break;
            case 'info':
                $width = 800;
                $heigth = 480;
                break;
            case 'mini-banner':
                $width = 1600;
                $heigth = 800;
                break;
            case 'info-room':
                $width = 1000;
                $heigth = 600;
                break;
        }
        $imageData = (new \App\Classes\AllIcons)->resize_image($url,$width,$heigth);
        imagepng($imageData,$url,9);
    }
}
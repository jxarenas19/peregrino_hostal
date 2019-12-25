<?php namespace App\Http\Controllers;

use crocodicstudio\crudbooster\controllers\CBController;

class AdminGeneralesTextoController extends CBController {


    public function cbInit()
    {
        $this->setTable("hp_general_text");
        $this->setPermalink("generales_texto");
        $this->setPageTitle("Generales Texto");

        $this->addText("Json","json")->strLimit(150)->maxLength(2000);
        $this->addTableKeyWorld();
		

    }

    private function addTableKeyWorld()
    {
        $reponse = array();
        if (cb()->getCurrentMethod()== 'getEdit' or cb()->getCurrentMethod()== 'getAdd'){
            $locales = cb()->findAll("locale")->toArray();
            $data = json_decode(cb()->findAll(
                "hp_general_text")->toArray()[0]->json,true);
            $keysData = array_keys($data['es']);
            $row = array();
            $response = array();
            foreach ($keysData as $k){
                $row[] = $k;
                foreach ($locales as $jj){
                    if (key_exists($jj->code,$data)){
                        $row[] = $data[$jj->code][$k];
                    }
                    else $row[] = '';
                }
                $response[] = $row;
                $row = array();
            }
            $this->addCustom("Palabras Claves", "custom-clave")->required(false)
                ->showIndex(false)
                ->setHtml(view("admin.custom_table2", ['data' =>
                    $response,
                    'locales'=>$locales])->render()
                );
        }
    }
}

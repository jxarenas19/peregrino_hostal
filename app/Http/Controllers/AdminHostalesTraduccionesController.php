<?php namespace App\Http\Controllers;

use crocodicstudio\crudbooster\controllers\CBController;

class AdminHostalesTraduccionesController extends CBController
{


    public function cbInit()
    {
        $this->setTable("hp_hostales_translations");
        $this->setPermalink("hostales_traducciones");
        $this->setPageTitle("Hostales Traducciones");

        $this->addSelectTable("Hostal", "hostal_id", ["table" => "hp_hostales", "value_option" => "id", "display_option" => "name-visual", "sql_condition" => ""]);
        $this->addText("Nomre", "name")->strLimit(150)->maxLength(255);
        $this->addWysiwyg("Pequeña Descripción", "mini_description")->strLimit(150);
        $this->addWysiwyg("Descripción", "description")->strLimit(150);
        $this->addText("Dirección", "address")->strLimit(150)->maxLength(255);
        $this->addSelectTable("Idioma", "locale", ["table" => "locale", "value_option" => "code", "display_option" => "name", "sql_condition" => ""])
            ->showIndex(false);
        $this->addImage("Icon", "icon")->encrypt(true)->resize(50, 50);


    }
}

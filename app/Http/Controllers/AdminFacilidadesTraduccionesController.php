<?php namespace App\Http\Controllers;

use crocodicstudio\crudbooster\controllers\CBController;

class AdminFacilidadesTraduccionesController extends CBController
{


    public function cbInit()
    {
        $this->setTable("hp_conforts_translations");
        $this->setPermalink("facilidades_traducciones");
        $this->setPageTitle("Facilidades Traducciones");

        $this->addSelectTable("Confort", "confort_id", ["table" => "hp_conforts", "value_option" => "id", "display_option" => "name-visual", "sql_condition" => ""]);
        $this->addText("Nombre", "name")->showDetail(false)->showAdd(false)->showEdit(false)->strLimit(150)->maxLength(255);
        $this->addSelectTable("Idioma", "locale", ["table" => "locale", "value_option" => "code", "display_option" => "name", "sql_condition" => ""]);
        $this->addImage("Icon", "icon")->encrypt(true);


    }
}

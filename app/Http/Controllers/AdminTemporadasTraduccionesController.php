<?php namespace App\Http\Controllers;

use crocodicstudio\crudbooster\controllers\CBController;

class AdminTemporadasTraduccionesController extends CBController
{


    public function cbInit()
    {
        $this->setTable("hp_seasons_translations");
        $this->setPermalink("temporadas_traducciones");
        $this->setPageTitle("Temporadas Traducciones");

        $this->addSelectTable("Temporada", "season_id", ["table" => "hp_seasons", "value_option" => "id", "display_option" => "name-visual", "sql_condition" => ""]);
        $this->addText("Nombre", "name")->strLimit(150)->maxLength(255);
        $this->addSelectTable("Idioma", "locale", ["table" => "locale", "value_option" => "code", "display_option" => "name", "sql_condition" => ""])
            ->showIndex(false);
        $this->addImage("Icon", "icon")->encrypt(true);


    }
}

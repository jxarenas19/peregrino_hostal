<?php namespace App\Http\Controllers;

use crocodicstudio\crudbooster\controllers\CBController;

class AdminTiposHabitacionesTraduccionesController extends CBController
{


    public function cbInit()
    {
        $this->setTable("hp_types_room_translations");
        $this->setPermalink("tiposhabitaciones_traducciones");
        $this->setPageTitle("TiposHabitaciones Traducciones");

        $this->addSelectTable("Tipo Habitación", "type_room_id", ["table" => "hp_types_room", "value_option" => "id", "display_option" => "name-visual", "sql_condition" => ""]);
        $this->addText("Nombre", "name")->strLimit(150)->maxLength(255);
        $this->addWysiwyg("Descripción", "description")->strLimit(150);
        $this->addSelectTable("Idioma", "locale", ["table" => "locale", "value_option" => "code", "display_option" => "name", "sql_condition" => ""])->showIndex(false);
        $this->addImage("Icon", "icon")->encrypt(true);


    }
}

<?php namespace App\Http\Controllers;

use crocodicstudio\crudbooster\controllers\CBController;

class AdminHabitacionesTraduccionesController extends CBController
{


    public function cbInit()
    {
        $this->setTable("hp_rooms_translations");
        $this->setPermalink("habitaciones_traducciones");
        $this->setPageTitle("Habitaciones Traducciones");

        $this->addSelectTable("Room", "room_id", ["table" => "hp_rooms", "value_option" => "id", "display_option" => "name-visual", "sql_condition" => ""]);
        $this->addText("Nombre", "name")->strLimit(150)->maxLength(255);
        $this->addWysiwyg("Descripción", "description")->strLimit(150);
        $this->addSelectTable("Idioma", "locale", ["table" => "locale", "value_option" => "code", "display_option" => "name", "sql_condition" => ""])
            ->showIndex(false);
        $this->addImage("Icon", "icon")->encrypt(true);


    }
}

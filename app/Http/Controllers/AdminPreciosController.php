<?php namespace App\Http\Controllers;

use crocodicstudio\crudbooster\controllers\CBController;

class AdminPreciosController extends CBController
{


    public function cbInit()
    {
        $this->setTable("hp_prices");
        $this->setPermalink("precios");
        $this->setPageTitle("Precios");

        $this->addSelectTable("Temporada", "season_id", ["table" => "hp_seasons", "value_option" => "id", "display_option" => "name-visual", "sql_condition" => ""]);
        $this->addMoney("Precio", "price");
        $this->addSelectTable("Hostal", "hostal_id", ["table" => "hp_hostales", "value_option" => "id", "display_option" => "name-visual", "sql_condition" => ""]);
        $this->addSelectTable("Room", "room_id", ["table" => "hp_rooms", "value_option" => "id", "display_option" => "name-visual", "sql_condition" => ""]);
        $this->addDatetime("Creado", "created_at")->required(false)->showAdd(false)->showEdit(false);
        $this->addDatetime("Actualizado", "updated_at")->required(false)->showAdd(false)->showEdit(false);


    }
}

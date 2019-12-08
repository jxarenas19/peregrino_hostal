<?php namespace App\Http\Controllers;

use crocodicstudio\crudbooster\controllers\CBController;

class AdminTempordaFechasController extends CBController {


    public function cbInit()
    {
        $this->setTable("hp_seasons_date");
        $this->setPermalink("temporda_fechas");
        $this->setPageTitle("Temporda Fechas");

        $this->addDate("Comienzo","begin")->format('Y-m-d');
		$this->addDate("Final","end")->format('Y-m-d');
		$this->addSelectTable("Temporada","season_id",["table"=>"hp_seasons","value_option"=>"id","display_option"=>"name-visual","sql_condition"=>""]);
		$this->addDatetime("Creado","created_at")->required(false)->showAdd(false)->showEdit(false);
		$this->addDatetime("Actualizado","updated_at")->required(false)->showAdd(false)->showEdit(false);
		

    }
}

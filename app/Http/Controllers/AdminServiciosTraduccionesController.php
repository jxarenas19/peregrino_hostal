<?php namespace App\Http\Controllers;

use crocodicstudio\crudbooster\controllers\CBController;

class AdminServiciosTraduccionesController extends CBController {


    public function cbInit()
    {
        $this->setTable("hp_services_translations");
        $this->setPermalink("servicios_traducciones");
        $this->setPageTitle("Servicios Traducciones");

        $this->addSelectTable("Servicio","service_id",["table"=>"hp_services","value_option"=>"id","display_option"=>"name-visual","sql_condition"=>""]);
		$this->addText("Nombre","name")->strLimit(150)->maxLength(255);
		$this->addWysiwyg("Descripción","description")->strLimit(150);
		$this->addSelectTable("Idioma","locale",["table"=>"locale","value_option"=>"code","display_option"=>"name","sql_condition"=>""]);
		$this->addImage("Icon","icon")->required(false)->showDetail(false)->showAdd(false)->showEdit(false)->encrypt(true);
		

    }
}

<?php namespace App\Http\Controllers;

use crocodicstudio\crudbooster\controllers\CBController;

class AdminPoliticasTraduccionesController extends CBController {


    public function cbInit()
    {
        $this->setTable("hp_politicas_translations");
        $this->setPermalink("politicas_traducciones");
        $this->setPageTitle("Politicas Traducciones");

        $this->addSelectTable("Politica","politica_id",["table"=>"hp_politicas","value_option"=>"id","display_option"=>"name-visual","sql_condition"=>""]);
		$this->addText("Nombre","name")->showDetail(false)->showAdd(false)->showEdit(false)->strLimit(150)->maxLength(255);
		$this->addSelectTable("Idioma","locale",["table"=>"locale","value_option"=>"code","display_option"=>"name","sql_condition"=>""]);
		$this->addImage("Icon","icon")->encrypt(true);
		

    }
}

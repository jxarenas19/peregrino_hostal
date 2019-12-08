<?php namespace App\Http\Controllers;

use crocodicstudio\crudbooster\controllers\CBController;

class AdminAboutTraduccionesController extends CBController {


    public function cbInit()
    {
        $this->setTable("hp_about_translations");
        $this->setPermalink("about_traducciones");
        $this->setPageTitle("About Traducciones");

        $this->addSelectTable("About","about_id",["table"=>"hp_about","value_option"=>"id","display_option"=>"name-visual","sql_condition"=>""]);
		$this->addText("Nombre","name")->strLimit(150)->maxLength(255);
		$this->addWysiwyg("Descripción","description")->strLimit(150);
		$this->addSelectTable("Idioma","locale",["table"=>"locale","value_option"=>"code","display_option"=>"name","sql_condition"=>""]);
		$this->addImage("Icon","icon")->encrypt(true);
		

    }
}

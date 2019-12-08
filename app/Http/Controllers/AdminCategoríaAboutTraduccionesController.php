<?php namespace App\Http\Controllers;

use crocodicstudio\crudbooster\controllers\CBController;

class AdminCategoríaAboutTraduccionesController extends CBController {


    public function cbInit()
    {
        $this->setTable("hp_category_about_translations");
        $this->setPermalink("categoria_about_traducciones");
        $this->setPageTitle("Categoría About Traducciones");

        $this->addSelectTable("Categoría","category_id",["table"=>"hp_category_about","value_option"=>"id","display_option"=>"name-visual","sql_condition"=>""]);
		$this->addText("Nombre","name")->strLimit(150)->maxLength(255);
		$this->addSelectTable("Idioma","locale",["table"=>"locale","value_option"=>"code","display_option"=>"name","sql_condition"=>""]);
		$this->addImage("Icon","icon")->encrypt(true);
		

    }
}

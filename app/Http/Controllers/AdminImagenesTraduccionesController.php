<?php namespace App\Http\Controllers;

use crocodicstudio\crudbooster\controllers\CBController;

class AdminImagenesTraduccionesController extends CBController {


    public function cbInit()
    {
        $this->setTable("hp_images_translations");
        $this->setPermalink("imagenes_traducciones");
        $this->setPageTitle("Imagenes Traducciones");

        $this->addSelectTable("Image","image_id",["table"=>"hp_images","value_option"=>"id","display_option"=>"name-visual","sql_condition"=>""]);
		$this->addText("Nombre","name")->strLimit(150)->maxLength(255);
		$this->addWysiwyg("Descripción","description")->strLimit(150);
		$this->addSelectTable("Idioma","locale",["table"=>"locale","value_option"=>"code","display_option"=>"name","sql_condition"=>""])->showIndex(false);;
        $this->addImage("Icon", "icon")->encrypt(true)->resize(50, 50);

    }
}

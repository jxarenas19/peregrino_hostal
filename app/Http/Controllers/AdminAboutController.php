<?php namespace App\Http\Controllers;

use crocodicstudio\crudbooster\controllers\CBController;

class AdminAboutController extends CBController {


    public function cbInit()
    {
        $this->setTable("hp_about");
        $this->setPermalink("about");
        $this->setPageTitle("About");

        $this->addText("Nombre","name-visual")->required(false)->showDetail(false)->showAdd(false)->showEdit(false)->strLimit(150)->maxLength(255);
		$this->addWysiwyg("Descripción","description-visual")->required(false)->showDetail(false)->showAdd(false)->showEdit(false)->strLimit(150);
		$this->addSelectTable("Categoría","category_id",["table"=>"hp_category_about","value_option"=>"id","display_option"=>"name-visual","sql_condition"=>""]);
		$this->addDatetime("Creado","created_at")->required(false)->showIndex(false)->showAdd(false)->showEdit(false);
		$this->addDatetime("Actualizado","updated_at")->required(false)->showIndex(false)->showAdd(false)->showEdit(false);
		

    }
}

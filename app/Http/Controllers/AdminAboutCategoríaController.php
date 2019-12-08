<?php namespace App\Http\Controllers;

use crocodicstudio\crudbooster\controllers\CBController;

class AdminAboutCategoríaController extends CBController {


    public function cbInit()
    {
        $this->setTable("hp_category_about");
        $this->setPermalink("about_categoria");
        $this->setPageTitle("About Categoría");

        $this->addText("Nombre","name-visual")->strLimit(150)->maxLength(255);
		$this->addDatetime("Creado","created_at")->required(false)->showIndex(false)->showAdd(false)->showEdit(false);
		$this->addDatetime("Actualizado","updated_at")->required(false)->showIndex(false)->showAdd(false)->showEdit(false);
		

    }
}

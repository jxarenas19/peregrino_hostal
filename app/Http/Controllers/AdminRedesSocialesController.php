<?php namespace App\Http\Controllers;

use crocodicstudio\crudbooster\controllers\CBController;

class AdminRedesSocialesController extends CBController {


    public function cbInit()
    {
        $this->setTable("hp_social");
        $this->setPermalink("redes_sociales");
        $this->setPageTitle("Redes Sociales");

        $this->addText("Nombre","name")->strLimit(150)->maxLength(255);
		$this->addText("Url","url")->strLimit(150)->maxLength(255);
        $this->addText("Icon","icon")->strLimit(150)->maxLength(255);
        $this->addRadio("Active", "active")->options([1 => 'Activo', 0 => 'No Activo'])
            ->indexDisplayTransform(function ($row) {
                if ($row == 1) return 'Activo';
                else return 'No Activo';
            });
		$this->addDatetime("Creado","created_at")->required(false)->showAdd(false)->showEdit(false);
		$this->addDatetime("Actualizado","updated_at")->required(false)->showAdd(false)->showEdit(false);
		

    }
}

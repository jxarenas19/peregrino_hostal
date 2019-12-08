<?php namespace App\Http\Controllers;

use App\Traits\GenericController;
use crocodicstudio\crudbooster\controllers\CBController;
use crocodicstudio\crudbooster\controllers\partials\ButtonColor;

class AdminAboutCategoríaController extends CBController {

    use GenericController;

    public function cbInit()
    {
        $this->setTable("hp_category_about");
        $this->setPermalink("about_categoria");
        $this->setPageTitle("About Categoría");

        $this->addText("Nombre","name-visual")->showAdd(false)->showEdit(false)->strLimit(150)->maxLength(255);
		$this->addDatetime("Creado","created_at")->required(false)->showIndex(false)->showAdd(false)->showEdit(false);
		$this->addDatetime("Actualizado","updated_at")->required(false)->showIndex(false)->showAdd(false)->showEdit(false);

        $this->addJavascriptCss();
        $this->hookAll();
        $this->addLocaleForm(columnSingleton()->getColumns());

        $this->addSubModule("Idiomas", AdminCategoríaAboutTraduccionesController::class, "category_id",
            function ($row) {
                return [
                    "Categoría" => $row->{"name-visual"}
                ];
            }, null, "fa fa-flag", null);

        $this->addSubModule("Abouts", AdminAboutController::class, "category_id",
            function ($row) {
                return [
                    "Categoría" => $row->{"name-visual"}
                ];
            }, null, "fa fa-cube", ButtonColor::LIGHT_BLUE);

    }

    public function getEdit($id)
    {
        return $this->upgradeEdit($id);
    }

    public function getDetail($id)
    {
        return $this->upgradeDetails($id);
    }
}

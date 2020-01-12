<?php namespace App\Http\Controllers;

use App\Traits\GenericController;
use crocodicstudio\crudbooster\controllers\CBController;

class AdminImagenesController extends CBController {

    use GenericController;

    public function cbInit()
    {
        $this->setTable("hp_images");
        $this->setPermalink("imagenes");
        $this->setPageTitle("Imagenes");

        $this->addText("Nombre","name-visual")->required(false)->showDetail(false)->showAdd(false)->showEdit(false)->strLimit(150)->maxLength(255);
		$this->addWysiwyg("Descripción","description-visual")->required(false)->showDetail(false)->showAdd(false)->showEdit(false)->strLimit(150);
		$this->addImage("Url","url");
        $this->addText("Estado","estado");
		$this->addRadio("Imagen Principal","main")->options([1=>'True',0=>'False']);
		$this->addSelectTable("Room","room_id",["table"=>"hp_rooms","value_option"=>"id","display_option"=>"name-visual","sql_condition"=>""]);
		$this->addDatetime("Creado","created_at")->required(false)->showAdd(false)->showEdit(false);
		$this->addDatetime("Actualizado","updated_at")->required(false)->showAdd(false)->showEdit(false);

        $this->addJavascriptCss();
        $this->hookAll();
        $this->addLocaleForm(columnSingleton()->getColumns());

        $this->addSubModule("Idiomas", AdminImagenesTraduccionesController::class, "image_id",
            function ($row) {
                return [
                    "Imagen" => $row->{"name-visual"}
                ];
            }, null, "fa fa-flag", null);
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

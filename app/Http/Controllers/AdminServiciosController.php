<?php namespace App\Http\Controllers;

use App\Traits\GenericController;
use crocodicstudio\crudbooster\controllers\CBController;
use Illuminate\Support\Facades\Storage;

class AdminServiciosController extends CBController {

    use GenericController;

    public function cbInit()
    {
        $this->setTable("hp_services");
        $this->setPermalink("servicios");
        $this->setPageTitle("Servicios");

        $this->addText("Nombre","name-visual")->showAdd(false)->showEdit(false)->strLimit(150)->maxLength(255);
		$this->addWysiwyg("Descripción","description-visual")->showAdd(false)->showEdit(false)->strLimit(150);
		$this->addSelectTable("Hostal","hostal_id",["table"=>"hp_hostales","value_option"=>"id","display_option"=>"name-visual","sql_condition"=>""])->required(false);
        $this->addImage("", "icon")->showAdd(false)
            ->visible(false)->resize(50, 50)->required(false);
		$icons = Storage::allfiles('assets/images/services');
        $this->addCustom("Servicio Icono", "icon")->required(false)
            ->showIndex(false)->showDetail(false)
            ->setHtml(view("admin.custom_upload_image", ['icons' => $icons])->render()
            );
		$this->addDatetime("Creado","created_at")->required(false)->showAdd(false)->showEdit(false);
		$this->addDatetime("Actualizado","updated_at")->required(false)->showAdd(false)->showEdit(false);

        $this->addJavascriptCss();
        $this->hookAll();
        $this->addLocaleForm(columnSingleton()->getColumns());

        $this->addSubModule("Idiomas", AdminServiciosTraduccionesController::class, "service_id",
            function ($row) {
                return [
                    "Servicio" => $row->{"name-visual"}
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

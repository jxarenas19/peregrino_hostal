<?php namespace App\Http\Controllers;

use App\Classes\AllIcons;
use App\Traits\GenericController;
use crocodicstudio\crudbooster\controllers\CBController;

class AdminPoliticasController extends CBController {

    use GenericController;

    public function cbInit()
    {
        $this->setTable("hp_politicas");
        $this->setPermalink("politicas");
        $this->setPageTitle("Politicas");

        $this->addText("Nombre", "name-visual")->showDetail(false)->showAdd(false)->showEdit(false)->strLimit(150)->maxLength(255);
        $this->addText("", "icon")
            ->visible(false)->showAdd(false)->required(false)->indexDisplayTransform(function($row) {
                if ($row) return "<i style='font-size: 20px' class='img-thumbnail ".$row."'/></i>";
                else return '';
            });
        $icons = new AllIcons();
        $this->addCustom("Iconos", "icon")->required(false)
            ->showIndex(false)->showDetail(false)
            ->setHtml(view("admin.custom_upload_icon", ['icons' => $icons->web()])->render()
            );
        $this->addDatetime("Creado", "created_at")->required(false)->showAdd(false)->showEdit(false);
        $this->addDatetime("Actualizado", "updated_at")->required(false)->showAdd(false)->showEdit(false);

        $this->addJavascriptCss();
        $this->hookAll();
        $this->addLocaleForm(columnSingleton()->getColumns());

        $this->addSubModule("Idiomas", AdminPoliticasTraduccionesController::class, "politica_id",
            function ($row) {
                return [
                    "Política" => $row->{"name-visual"}
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

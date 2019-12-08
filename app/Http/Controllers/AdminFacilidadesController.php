<?php namespace App\Http\Controllers;

use App\Traits\GenericController;
use crocodicstudio\crudbooster\controllers\CBController;

class AdminFacilidadesController extends CBController
{


    use GenericController;

    public function cbInit()
    {
        $this->setTable("hp_conforts");
        $this->setPermalink("facilidades");
        $this->setPageTitle("Facilidades");

        $this->addText("Nombre", "name-visual")->showDetail(false)->showAdd(false)->showEdit(false)->strLimit(150)->maxLength(255);
        $this->addDatetime("Creado", "created_at")->required(false)->showAdd(false)->showEdit(false);
        $this->addDatetime("Actualizado", "updated_at")->required(false)->showAdd(false)->showEdit(false);

        $this->addJavascriptCss();
        $this->hookAll();
        $this->addLocaleForm(columnSingleton()->getColumns());

        $this->addSubModule("Idiomas", AdminFacilidadesTraduccionesController::class, "confort_id",
            function ($row) {
                return [
                    "Facilidad" => $row->{"name-visual"}
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

<?php namespace App\Http\Controllers;

use App\Traits\GenericController;
use crocodicstudio\crudbooster\controllers\CBController;

class AdminTiposHabitacionController extends CBController
{

    use GenericController;

    public function cbInit()
    {
        $this->setTable("hp_types_room");
        $this->setPermalink("tipos_habitacion");
        $this->setPageTitle("Tipos Habitación");

        $this->addText("Nombre", "name-visual")->required(false)->showDetail(false)->showAdd(false)->showEdit(false)->strLimit(150)->maxLength(255);
        $this->addWysiwyg("Descripción", "description-visual")->required(false)->showDetail(false)->showAdd(false)->showEdit(false)->strLimit(150);
        $this->addDatetime("Creado", "created_at")->required(false)->showAdd(false)->showEdit(false);
        $this->addDatetime("Actualizado", "updated_at")->required(false)->showAdd(false)->showEdit(false);

        $this->addJavascriptCss();
        $this->hookAll();
        $this->addLocaleForm(columnSingleton()->getColumns());

        $this->addSubModule("Idiomas", AdminTiposHabitacionesTraduccionesController::class, "type_room_id",
            function ($row) {
                return [
                    "Tipo habitación" => $row->{"name-visual"}
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

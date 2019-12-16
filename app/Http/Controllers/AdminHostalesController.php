<?php namespace App\Http\Controllers;

use App\Traits\GenericController;
use crocodicstudio\crudbooster\controllers\CBController;
use crocodicstudio\crudbooster\controllers\partials\ButtonColor;

class AdminHostalesController extends CBController
{

    use GenericController;

    public function cbInit()
    {
        $this->setTable("hp_hostales");
        $this->setPermalink("hostales");
        $this->setPageTitle("Hostales");

        $this->addText("Nombre", "name-visual")->showDetail(false)->showAdd(false)->showEdit(false)->filterable(true)->strLimit(150)->maxLength(255);
        $this->addWysiwyg("Mini Descripción", "mini_description-visual")->showDetail(false)->showAdd(false)->showEdit(false)->filterable(true)->strLimit(150);
        $this->addWysiwyg("Descripción", "description-visual")->showDetail(false)->showAdd(false)->showEdit(false)->filterable(true)->strLimit(150);
        $this->addText("Direccción", "address-visual")->showDetail(false)->showAdd(false)->showEdit(false)->filterable(true)->strLimit(150)->maxLength(255);
        $this->addText("Email", "email")->filterable(true);
        $this->addText("Teléfono", "phone")->filterable(true);
        $this->addText("Latitud", "latitude")->filterable(true)->strLimit(150)->maxLength(255);
        $this->addText("Longitud", "length")->filterable(true)->strLimit(150)->maxLength(255);
        $this->addDatetime("Creado", "created_at")->required(false)->showAdd(false)->showEdit(false);
        $this->addDatetime("Actualizado", "updated_at")->required(false)->showAdd(false)->showEdit(false);

        $this->addJavascriptCss();
        $this->hookAll();
        $this->addLocaleForm(columnSingleton()->getColumns());

        $this->addSubModule("Idiomas", AdminHostalesTraduccionesController::class, "hostal_id",
            function ($row) {
                return [
                    "Hostal" => $row->{"name-visual"}
                ];
            }, null, "fa fa-flag", null);

        $this->addSubModule("Habitaciones", AdminHabitacionesController::class, "hostal_id",
            function ($row) {
                return [
                    "Hostal" => $row->{"name-visual"}
                ];
            }, null, "fa fa-hotel", ButtonColor::LIGHT_BLUE);

        $this->addSubModule("Servicios", AdminServiciosController::class, "hostal_id",
            function ($row) {
                return [
                    "Hostal" => $row->{"name-visual"}
                ];
            }, null, "fa fa-shopping-basket", ButtonColor::GREEN);

        $this->addSubModule("Imágenes", AdminImagenesHostalController::class, "hostal_id",
            function ($row) {
                return [
                    "Hostal" => $row->{"name-visual"}
                ];
            }, null, "fa fa-file-image-o", ButtonColor::YELLOW);
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

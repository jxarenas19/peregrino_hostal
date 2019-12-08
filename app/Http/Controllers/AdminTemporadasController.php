<?php namespace App\Http\Controllers;

use App\Traits\GenericController;
use crocodicstudio\crudbooster\controllers\CBController;
use crocodicstudio\crudbooster\controllers\partials\ButtonColor;

class AdminTemporadasController extends CBController
{

    use GenericController;

    public function cbInit()
    {
        $this->setTable("hp_seasons");
        $this->setPermalink("temporadas");
        $this->setPageTitle("Temporadas");

        $this->addText("Nombre", "name-visual")->required(false)->showDetail(false)->showAdd(false)->showEdit(false)->strLimit(150)->maxLength(255);

        $this->addDatetime("Creado", "created_at")->required(false)->showAdd(false)->showEdit(false);
        $this->addDatetime("Actualizado", "updated_at")->required(false)->showAdd(false)->showEdit(false);

        $this->addJavascriptCss();
        $this->hookAll();
        $this->addLocaleForm(columnSingleton()->getColumns());

        $this->addSubModule("Idiomas", AdminTemporadasTraduccionesController::class, "season_id",
            function ($row) {
                return [
                    "Temporada" => $row->{"name-visual"}
                ];
            }, null, "fa fa-flag", null);

        $this->addSubModule("Fechas", AdminTempordaFechasController::class, "season_id",
            function ($row) {
                return [
                    "Temporada" => $row->{"name-visual"}
                ];
            }, null, "fa fa-calendar", ButtonColor::LIGHT_BLUE);

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

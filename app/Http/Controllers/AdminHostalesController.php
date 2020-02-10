<?php namespace App\Http\Controllers;

use App\Models\Site\Hostal;
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
        $this->addText("Latitud", "latitude")->showIndex(false)->filterable(true)->strLimit(150)->maxLength(255);
        $this->addText("Longitud", "length")->showIndex(false)->filterable(true)->strLimit(150)->maxLength(255);
        $this->addSelectPoliticas();
        $this->addRadio("Active", "active")->options([1 => 'Activo', 0 => 'No Activo'])
            ->indexDisplayTransform(function ($row) {
                if ($row == 1) return 'Activo';
                else return 'No Activo';
            });
        $this->addDatetime("Creado", "created_at")->showIndex(false)->required(false)->showAdd(false)->showEdit(false);
        $this->addDatetime("Actualizado", "updated_at")->showIndex(false)->required(false)->showAdd(false)->showEdit(false);

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

    public function addSelectPoliticas()
    {
        if (cb()->getCurrentMethod()== 'getEdit' or cb()->getCurrentMethod()== 'getAdd'){
            $temp = explode('/', $_SERVER["REDIRECT_URL"]);
            $hostal_id = end($temp);
            $politicas= cb()->findAll("hp_politicas")->toArray();
            $values = array();
            foreach ($politicas as $item) {
                if (cb()->find('hp_politicas_hostales',
                    ['politica_id' => $item->id, 'hostal_id' => $hostal_id])) {
                    $values[] = array(
                        'value' => "politica-" . $item->id,
                        'name' => $item->{"name-visual"},
                        'selected' => true
                    );
                } else {
                    $values[] = array(
                        'value' => "politica-" . $item->id,
                        'name' => $item->{"name-visual"},
                        'selected' => false
                    );
                }


            }
            $this->addCustom("Políticas", "politicas_id")->required(false)
                ->setHtml(view("admin.custom_select2", ['values' => $values, 'name' => 'politicas-at[]'])->render()
                );
        }
        else {
            $this->addText("Políticas", "politicas-at")
                ->showAdd(false)->showEdit(false)
//                ->indexDisplayTransform(function($row) {
//                    if ($row) return "<i style='font-size: 20px' class='img-thumbnail ".$row."'/></i>";
//                    else return '';
//                })
                ->filterable(true)->strLimit(150)->maxLength(255);


        }
    }

    public function getEdit($id)
    {
        return $this->upgradeEdit($id);
    }

    public function getDetail($id)
    {
        return $this->upgradeDetails($id);
    }

    public function getIndex()
    {
        $indexData = parent::getIndex();
        $items = $indexData->getData()['result']->getCollection();
        $items->transform(function ($value) {


            $row = json_decode(json_encode($value), true);
            $politicas = Hostal::all()
                ->where('id','=',$value->primary_key)->first()
                ->politicas()->get(['name-visual'])->toArray();
            $facili = '';
            foreach ($politicas as $it){
                $facili =$facili.",".$it["name-visual"];
            }
            $row['politicas-at'] = $facili;
            return json_decode(json_encode($row));
        });
        return view("crudbooster::module.index.index",
            $indexData->getData());
    }
}

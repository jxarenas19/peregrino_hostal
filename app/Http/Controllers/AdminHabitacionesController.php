<?php namespace App\Http\Controllers;

use App\Models\Site\Room;
use App\Traits\GenericController;
use crocodicstudio\crudbooster\controllers\CBController;
use crocodicstudio\crudbooster\controllers\partials\ButtonColor;
use Illuminate\Support\Facades\DB;

class AdminHabitacionesController extends CBController
{

    use GenericController;

    public function cbInit()
    {
        $this->setTable("hp_rooms");
        $this->setPermalink("habitaciones");
        $this->setPageTitle("Habitaciones");

        $this->addText("Nombre", "name-visual")->showAdd(false)->showEdit(false)->filterable(true)->strLimit(150)->maxLength(255);
        $this->addWysiwyg("Descripción", "description-visual")->showAdd(false)->showEdit(false)->filterable(true)->strLimit(150);
        $this->addSelectTable("Hostal", "hostal_id", ["table" => "hp_hostales", "value_option" => "id", "display_option" => "name-visual", "sql_condition" => ""]);
        $this->addSelectTable("Tipo Habitación", "type_room_id", ["table" => "hp_types_room", "value_option" => "id", "display_option" => "name-visual", "sql_condition" => ""]);
        $this->addHidden("dd", "precios-at")->showIndex(false);
        $this->addSelectFacilidades();

        $this->addTablePrecios();

        $this->addDatetime("Creado", "created_at")->required(false)->showAdd(false)->showEdit(false);
        $this->addDatetime("Actualizado", "updated_at")->required(false)->showAdd(false)->showEdit(false);


        $this->addJavascriptCss();
        $this->hookAll();
        $this->addLocaleForm(columnSingleton()->getColumns());


        $this->addSubModule("Idiomas", AdminHabitacionesTraduccionesController::class, "room_id",
            function ($row) {
                return [
                    "Hostal" => $row->{"name-visual"}
                ];
            }, null, "fa fa-flag", null);

        $this->addSubModule("Precios", AdminPreciosController::class, "room_id",
            function ($row) {
                return [
                    "Habitación" => $row->{"name-visual"}
                ];
            }, null, "fa fa-usd", ButtonColor::LIGHT_BLUE);
    }

    /**metodo encargado de agregar el combo con los hostales
     * @throws \Throwable
     */
    public function addSelectFacilidades()
    {
        if (cb()->getCurrentMethod()== 'getEdit' or cb()->getCurrentMethod()== 'getAdd'){
        $temp = explode('/', $_SERVER["REDIRECT_URL"]);
        $room_id = end($temp);
        $conforts = cb()->findAll("hp_conforts")->toArray();
        $values = array();
        foreach ($conforts as $item) {
            if (cb()->find('hp_conforts_rooms',
                ['confort_id' => $item->id, 'room_id' => $room_id])) {
                $values[] = array(
                    'value' => "confort-" . $item->id,
                    'name' => $item->{"name-visual"},
                    'selected' => true
                );
            } else {
                $values[] = array(
                    'value' => "confort-" . $item->id,
                    'name' => $item->{"name-visual"},
                    'selected' => false
                );
            }


        }
        $this->addCustom("Facilidades", "confort_id")->required(false)
            ->setHtml(view("admin.custom_select2", ['values' => $values, 'name' => 'confort_id[]'])->render()
            );
        }
        else {
            $this->addText("Facilidades", "facilidades-at")
                ->showAdd(false)->showEdit(false)
                ->filterable(true)->strLimit(150)->maxLength(255);

        }
    }

    public function addTablePrecios()
    {
        if (cb()->getCurrentMethod()== 'getEdit' or cb()->getCurrentMethod()== 'getAdd'){
            $type_rooms = cb()->findAll("hp_seasons")->toArray();
            $temp = explode('/', $_SERVER["REDIRECT_URL"]);
            $room_id = end($temp);
            $prices = DB::table('hp_prices')
                ->where('room_id','=',$room_id)
                ->pluck('price','season_id')->toArray();
            $this->addCustom("Precio Por Temporada", "custom-precio")->required(false)
                ->showIndex(false)
                ->setHtml(view("admin.custom_table", ['rows' =>
                    json_decode(json_encode($type_rooms), true),
                    'prices'=>$prices])->render()
                );


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
            $conforts = Room::all()
                ->where('id','=',$value->primary_key)->first()
                ->conforts()->get(['name-visual'])->toArray();
            $facili = '';
            foreach ($conforts as $it){
                $facili =$facili.",".$it["name-visual"];
            }
            $row['facilidades-at'] = $facili;
            return json_decode(json_encode($row));
        });
        return view("crudbooster::module.index.index",
            $indexData->getData());
    }

    public function getSubModule($subModuleKey)
    {
        $subModuleData = parent::getSubModule($subModuleKey);
        $items = $subModuleData->getData()['result']->getCollection();
        $items->transform(function ($value) {
            $row = json_decode(json_encode($value), true);
            $conforts = Room::all()
                ->where('id','=',$value->primary_key)->first()
                ->conforts()->get(['name-visual'])->toArray();
            $facili = '';
            foreach ($conforts as $it){
                $facili =$facili.",".$it["name-visual"];
            }
            $row['facilidades-at'] = $facili;
            return json_decode(json_encode($row));
        });
        return view("crudbooster::module.index.index",
            $subModuleData->getData());
    }

}

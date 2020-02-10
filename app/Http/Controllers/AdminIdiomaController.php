<?php namespace App\Http\Controllers;

use crocodicstudio\crudbooster\controllers\CBController;
use Illuminate\Support\Facades\Storage;

class AdminIdiomaController extends CBController
{


    public function cbInit()
    {
        $this->setTable("locale");
        $this->setPermalink("idioma");
        $this->setPageTitle("Idiomas");

        $this->addText("Abreviatura", "code")->strLimit(150)->maxLength(255);
        $this->addText("Name", "name")->strLimit(150)->maxLength(255);
        $this->addRadio("Active", "active")->options([1 => 'Activo', 0 => 'No Activo'])
            ->indexDisplayTransform(function ($row) {
                if ($row == 1) return 'Activo';
                else return 'No Activo';
            });
        $this->addDatetime("Creado", "created_at")->required(false)->showAdd(false)->showEdit(false);
        $this->addDatetime("Modificado", "updated_at")->required(false)->showAdd(false)->showEdit(false);
        $this->addImage("", "icon")->showAdd(false)
            ->visible(false)->resize(50, 50)->required(false);

        $icons = Storage::allfiles('assets/images/flags');
        $this->addCustom("Bandera Icono", "icon")->required(false)->showIndex(false)->showDetail(false)
            ->setHtml(view("admin.custom_upload_image", ['icons' => $icons])->render()
            );

    }
}

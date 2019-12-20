<?php


namespace App\Traits;


use App\Classes\UtilSave;
use App\Models\Site\Room;

trait GenericController
{
    public function addJavascriptCss()
    {
        self::style(function () {
            return "
  
        
        .divider {								/* minor cosmetics */
            display: table; 
            font-size: 24px; 
            text-align: center; 
            width: 75%; 						/* divider width */
            margin: 20px auto;					/* spacing above/below */
        }
        .divider span { display: table-cell; position: relative; }
        .divider span:first-child, .divider span:last-child {
            width: 50%;
            top: 20px;							/* adjust vertical align */
            -moz-background-size: 100% 2px; 	/* line width */
            background-size: 100% 2px; 			/* line width */
            background-position: 0 0, 0 100%;
            background-repeat: no-repeat;
        }
        .divider span:first-child {				/* color changes in here */
            background-image: -webkit-gradient(linear, 0 0, 0 100%, from(transparent), to(#000));
            background-image: -webkit-linear-gradient(180deg, transparent, #000);
            background-image: -moz-linear-gradient(180deg, transparent, #000);
            background-image: -o-linear-gradient(180deg, transparent, #000);
            background-image: linear-gradient(90deg, transparent, #000);
        }
        .divider span:nth-child(2) {
            color: #000; padding: 0px 5px; width: auto; white-space: nowrap;
        }
        .divider span:last-child {				/* color changes in here */
            background-image: -webkit-gradient(linear, 0 0, 0 100%, from(#000), to(transparent));
            background-image: -webkit-linear-gradient(180deg, #000, transparent);
            background-image: -moz-linear-gradient(180deg, #000, transparent);
            background-image: -o-linear-gradient(180deg, #000, transparent);
            background-image: linear-gradient(90deg, #000, transparent);}
            
            .divider img {
                top:1px; bottom:1px;
                left:2px; right:2px;
                border-radius:100%;
                border:1px dashed #68beaa;
                text-align:center;
                line-height:40px;
                font-style:normal;
                 color:#049372;
            }
            ";
        });

    }

    public function hookAll()
    {
        self::hookBeforeInsert(function ($data) {
            $utilTranslation = new UtilSave($data,
                self::table() . "_translations");
            $GLOBALS['lenguageData'] = $utilTranslation->findLanguageData();
            $GLOBALS['confortData'] = $utilTranslation->findConfortData();
            $GLOBALS['politicaData'] = $utilTranslation->findPoliticasData();
            $GLOBALS['priceData'] = $utilTranslation->findPriceData();
            $data = $utilTranslation->deleteExtraField($data);
            $data = $utilTranslation->addDefaultValueData($data);
            return $data;


        });
        self::hookAfterInsert(function ($last_insert_id) {
            $utilTranslation = new UtilSave($last_insert_id,
                self::table() . "_translations");
            $utilTranslation->saveTranslations($last_insert_id);
            $utilTranslation->saveConforts($last_insert_id);
            $utilTranslation->savePoliticas($last_insert_id);
            $utilTranslation->savePrices($last_insert_id);

        });
        self::hookBeforeUpdate(function ($data, $id) {

            $utilTranslation = new UtilSave($data,
                self::table() . "_translations");
            $GLOBALS['lenguageData'] = $utilTranslation->findLanguageData();
            $GLOBALS['confortData'] = $utilTranslation->findConfortData();
            $GLOBALS['politicaData'] = $utilTranslation->findPoliticasData();
            $GLOBALS['priceData'] = $utilTranslation->findPriceData();
            $data = $utilTranslation->deleteExtraField($data);
            $data = $utilTranslation->addDefaultValueData($data);
            return $data;


        });
        self::hookAfterUpdate(function ($id) {
            $utilTranslation = new UtilSave($id,
                self::table() . "_translations");
            $utilTranslation->saveTranslations($id);
            $utilTranslation->deleteAllConforts($id);
            $utilTranslation->saveConforts($id);
            $utilTranslation->savePoliticas($id);
            $utilTranslation->savePrices($id);

        });
    }

    /**Metodo encargado de añadir los camposde idioma en cada
     * formulario
     * @param $data
     */
    public function addLocaleForm($data)
    {
        $locales = cb()->findAll("locale")->toArray();
        foreach ($locales as $locale) {
            $url = asset($locale->icon);
            $this->addCustom("")->required(false)->setHtml(
                "<div class='divider'><span></span><span>
                        <img src='" . $url . "' width='50' height='50' />
                        </span><span></span></div>"
            )->showIndex(false);
            foreach ($data as $item) {
                if (strrpos($item->getField(), '-visual') !== false) {
                    switch ($item->getType()) {
                        case "text":
                            $this->addText($item->getLabel() . " en " .
                                $locale->name, $item->getField() . "-" . $locale->code)
                                ->showIndex(false)->required(true);
                            break;
                        case "wysiwyg":
                            $this->addTextArea($item->getLabel() . " en " .
                                $locale->name, $item->getField() . "-" . $locale->code)
                                ->showIndex(false)->required(false);
                    }
                }

            }
            $this->addHidden("", "id-visual-" . $locale->code)
                ->showDetail(false)->showIndex(false);

        }
    }



    public function upgradeIndex()
    {
        $indexData = parent::getIndex();
        $items = $indexData->getData()['result']->getCollection();
        $items->transform(function ($value) {
            $trans = self::findElementTranslations($value->primary_key)
                ->where('locale', '=', 'es')->first();
            $row = json_decode(json_encode($value), true);
            $fields = $this->fieldsTranslationDefault($trans);
            foreach ($fields as $key => $val) {
                $row[$key . "-visual"] = $fields[$key];
            }
            return json_decode(json_encode($row));
        });
        return view("crudbooster::module.index.index",
            $indexData->getData());
    }

    public function findElementTranslations($id)
    {
        $columnsName = cb()->listAllColumns(self::table() . "_translations");

        $translations = cb()->findAll(self::table() . "_translations", [$columnsName[1] => $id]);
        return $translations;

    }

    public function fieldsTranslationDefault($trans)
    {
        $transArray = json_decode(json_encode($trans), true);
        unset($transArray['locale']);
        unset($transArray['id']);
        array_shift($transArray);
        return $transArray;
    }

    public function upgradeEdit($id)
    {
        $editData = parent::getEdit($id);
        $row = json_decode(json_encode($editData->getData()), true);

        $translations = self::findElementTranslations($id);
        foreach ($translations as $value) {
            foreach ($value as $key => $va) {
                $row['row'][$key . "-visual-" . $value->locale] = $va;
            }
        }
        switch ($row["table"]) {
            case 'hp_rooms':
                $conforts = Room::where('id', '=', $id)->first()->conforts()->get();
                $values = array();
                foreach ($conforts as $item) {
                    $values[] = array(
                        'value' => "confort-" . $item->id,
                        'name' => $item->{"name-visual"},
                        'selected' => true
                    );
                }
                $row['row']['confort_id'] = $values;
                break;
        }
        $row['row'] = json_decode(json_encode($row['row']));
        return view('crudbooster::module.form.form', $row);

    }

    public function upgradeDetails($id)
    {
        $detailData = parent::getDetail($id);
        $row = json_decode(json_encode($detailData->getData()), true);

        $translations = self::findElementTranslations($id);
        foreach ($translations as $value) {
            foreach ($value as $key => $va) {
                $row['row'][$key . "-visual-" . $value->locale] = $va;
            }
        }
        $row['row'] = json_decode(json_encode($row['row']));
        return view('crudbooster::module.form.form_detail', $row);

    }


}
<?php


namespace app\models;


use enterprices\App;
//use enterprices\Converter;
//use enterprices\Validator;

class AddCarModel extends AppModel {
    private $prevPage;
    private $prevRouting;
    private $data;
    private $errorList = [];
    private $modalPages = [];

    public function __construct() {
        $this->modalPages = App::$app->getProperty('add_modal_pages');
        $this->prevPage = $_SERVER['HTTP_REFERER'] ?? '';
        $this->prevRouting = self::getPrevRouting($this->prevPage);
    }

    public function dataInit() {
        $this->errorListInit();
        if(isset($this->errorList['errors'])) {
            return false;
        }

        // TODO: Conditions data init


        if(isset($this->errorList['errors'])) {
            return false;
        }

        return true;
    }


    // WARNING: do not edit methods getData, getErrorList, getPrevPage, errorListInit
    public function getData() {
        return $this->data;
    }

    public function getErrorList() {
        return $this->errorList;
    }

    public function getPrevPage() {
        return $this->prevPage;
    }

    private function errorListInit() {
        $this->errorList = [
            'controller' => $this->prevRouting['controller'] ?? '',
            'action' => $this->prevRouting['action'] ?? ''
        ];

        foreach($this->modalPages as $modalPage) {
            if($modalPage['controller'] === $this->errorList['controller'] &&
                $modalPage['action'] === $this->errorList['action']) {
                return;
            }
        }

        $this->errorList['errors'][] = 'Запрос был отправлен некорректно';
    }
}
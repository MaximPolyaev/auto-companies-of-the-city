<?php


namespace app\controllers;


use RedBeanPHP\R;

class CarController extends AppController {
    public function __construct($route) {
        parent::__construct($route);
    }

    public function modelsAction() {
        $status = isset($_GET['status']) ? $_GET['status'] : '';
        $nameMark = isset($_GET['name_mark']) ? $_GET['name_mark'] : '';

        $models = R::getAll("select car_models.* from car_marks, car_models 
                where car_marks.id = car_models.id_mark 
                and car_marks.status = ? 
                and car_marks.name_alias = ?", [$status, $nameMark]);

        if($this->isAjax()) {
            $this->loadView('models', compact('models'));
        }
        redirect();
    }

}
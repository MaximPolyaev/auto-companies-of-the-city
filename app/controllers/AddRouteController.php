<?php


namespace app\controllers;


use RedBeanPHP\R;

class AddRouteController extends AppController {
    private $routeData = [];
    public function __construct($route) { parent::__construct($route); }

    public function indexAction() {
        if($this->dataInit()) {
            $this->dataSend();
        }
        echo '<h1>Сервер временно не работает!</h1>';
        die;
    }

    private function dataSend() {
        $routes = R::dispense('busroutes');

        foreach($this->data as $key => $value) {
            $routes->$key = $value;
        }

        R::begin();
        try {
            R::store($routes);
            R::commit();
        } catch(\Exception $e) {
            R::rollback();
            if(DEBUG) {
                echo $e->getMessage();
            } else {
                echo '<h1>Ошибка отправки данных!</h1>';
            }
            die;
        }
        redirect();
    }

    private function dataInit() {
        if(isset($_GET['name']) && !empty($_GET['name'])) {
            $this->data['name'] = $_GET['name'];
            $this->data['name_alias'] = rus_translate($_GET['name']);
        } else {
            return false;
        }
        if(isset($_GET['shortdesc']) && !empty($_GET['shortdesc'])) {
            $this->data['short_desc'] = $_GET['shortdesc'];
        } else {
            return false;
        }
        if(isset($_GET['desc']) && !empty($_GET['desc'])) {
            $this->data['desc'] = $_GET['desc'];
        } else {
            return false;
        }
        return true;
    }
}
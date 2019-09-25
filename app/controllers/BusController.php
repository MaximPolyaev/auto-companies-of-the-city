<?php


namespace app\controllers;


use RedBeanPHP\R;

class BusController extends AppController {
    public function routeAction() {
        if(!isset($this->route['select'])) {
            throw new \Exception("Bus route not found", 404);
        }
        $routeData = (object) R::getRow('SELECT * FROM `bus_routes` WHERE `name_alias` = ?', [$this->route['select']]);

        $this->set(compact('routeData'));
    }
}
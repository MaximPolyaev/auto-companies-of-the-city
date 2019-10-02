<?php


namespace app\controllers;


use RedBeanPHP\R;

class BusController extends AppController {
    public function routeAction() {
        if(!isset($this->route['select'])) {
            throw new \Exception("Bus route not found", 404);
        }
        $routeData = R::getRow('SELECT * FROM busroutes WHERE `name_alias` = ?', [$this->route['select']]);
        if(!$routeData) redirect(PATH . '/department/bus/routes');
        $routeData = (object) $routeData;
        $this->set(compact('routeData'));
    }
}
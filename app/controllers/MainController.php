<?php


namespace app\controllers;

use enterprices\App;
use enterprices\Cache;
use RedBeanPHP\R;


class MainController extends AppController {

    public function indexAction() {
        $this->setMeta(App::$app->getProperty('enterprices_name'));
        $numberDrivers = $this->getNumberDrivers();
        $this->set(compact('numberDrivers'));
    }

    private function getNumberDrivers() {
        $numberDrivers = R::getAssoc('SELECT position, COUNT(*) FROM `drivers` GROUP BY position');
        $numberDrivers['all_drivers'] = $numberDrivers['driver_taxi'] + $numberDrivers['driver_truck'] + $numberDrivers['driver_bus'];
        return (object) $numberDrivers;
    }
}
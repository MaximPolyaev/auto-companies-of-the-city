<?php


namespace app\controllers;

use enterprices\App;
use enterprices\Cache;
use RedBeanPHP\R;


class MainController extends AppController {

    public function indexAction() {
        $this->setMeta(App::$app->getProperty('enterprices_name'));
        $numberDrivers = $this->getNumberDrivers();
        $numberCars = $this->getNumberCars();
        $this->set(compact('numberDrivers', 'numberCars'));
    }

    private function getNumberDrivers() {
        $numberDrivers = R::getAssoc('SELECT position, COUNT(*) FROM `drivers` GROUP BY position');
        $numberDrivers['all_drivers'] = $numberDrivers['driver_taxi'] + $numberDrivers['driver_truck'] + $numberDrivers['driver_bus'];
        return (object) $numberDrivers;
    }

    private function getNumberCars() {
        return (object) R::getAssoc('select position, count(*) from `cars` group by position');
    }
}
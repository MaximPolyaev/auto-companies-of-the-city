<?php


namespace app\controllers;

use app\widgets\add\car\AddModalCar;
use app\widgets\add\driver\AddModalDriver;
use enterprices\App;
use RedBeanPHP\R;

class DepartmentController extends AppController {
    public function __construct($route) {
        parent::__construct($route);
        // Initialize car body types
        App::$app->setProperty('body_types_cars', self::cacheBodyTypesCar());


        // drivers and cars
        $drivers = $this->getDrivers();
        $cars = $this->getCars();
        $this->set(compact('drivers', 'cars'));

        // Route Modifier Rendering
        if(isset($this->route['modificator'])) {
            $modificator = $this->route['modificator'];
            $this->set(compact('modificator'));
        }

        // Add modals windows on page
        $addModalDriver = (new AddModalDriver($this->route))->getData();
        $addModalCar = (new AddModalCar($this->route))->getData();
        $this->set(compact('addModalDriver', 'addModalCar'));
    }

    public function taxiAction() {
        $this->setMeta('Отдел такси');
    }

    public function truckAction() {
        $this->setMeta('Отдел грузового ТС');
    }

    public function busAction() {
        $this->setMeta('Автобусный отдел');

        $busRoutes = R::findAll('busroutes');

        $this->set(compact('busRoutes'));
    }

    private function getDrivers() {
        $drivers = R::getAssoc('SELECT * FROM `drivers` WHERE position = ? and fired = 0', ['driver_' . $this->view]);
        foreach($drivers as $key => &$driver) {
            $driver['id'] = $key;
            $driver['str_experience'] = $driver['date_experience'] % 100 >= 5 && $driver['date_experience'] <= 20 ? 'лет' :
                ($driver['date_experience'] % 10 == 1 ? 'год' :
                    ($driver['date_experience'] % 10 >= 2 && $driver['date_experience'] % 10 <= 4 ? 'года' : 'лет'));
            if(preg_match('/^([7])(\d{3})(\d{3})(\d{2})(\d{2})/iu', $driver['number_phone'], $matches)) {
                $driver['phone_render'] = "+$matches[1] ($matches[2]) $matches[3]-$matches[4]-$matches[5]";
            } else {
                $driver['number_phone'] = '';
            }
            $driver = (object) $driver;
        }
        return $drivers;
    }

    private function getCars() {
        $cars = R::getAssoc('SELECT * FROM `cars` WHERE position = ? and repair = 0', ['car_' . $this->view]);
        foreach($cars as $key => &$car) {
            $car['id'] = $key;
            $car = (object) $car;
        }
        return $cars;
    }
}
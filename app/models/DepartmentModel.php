<?php


namespace app\models;


use RedBeanPHP\R;

class DepartmentModel extends AppModel {
    private $controller;
    private $view;
    public function __construct($route) {
        $this->controller = $route['controller'];
        $this->view = $route['action'];
    }

    public function getDrivers() {
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

    public function getCars() {
        function getCarBodyType($id) {
            $bodyType = R::findOne('body_types_cars', ' id = ?', [$id]);
            return isset($bodyType->name) ? $bodyType->name : '';
        }

        function getCarBrand($id) {
            $carBrand = R::findOne('car_marks', ' id = ?', [$id]);
            return isset($carBrand->name) ? $carBrand->name : '';
        }

        function getCarModel($id) {
            $carModel = R::findOne('car_models', ' id = ?', [$id]);
            return isset($carModel->name) ? $carModel->name : '';
        }

        function getTruckCarrying($id) {
            $carrying = R::findOne('carstruck', ' id_car = ?', [$id]);
            return isset($carrying->carrying) ? $carrying->carrying : '';
        }

        function getBusCapacity($id) {
            $bus = R::findOne('carsbus', ' id_car = ?', [$id]);
            return isset($bus->capacity) ? $bus->capacity : '';
        }

        $cars = R::getAssoc('SELECT * FROM `cars` WHERE position = ? and repair = 0', ['car_' . $this->view]);
        foreach($cars as $key => &$car) {
            $car['id'] = $key;
            $car['brand'] = getCarBrand($car['brand']);
            $car['model'] = getCarModel($car['model']);
            if($this->view === 'taxi') {
                $car['body_type'] = getCarBodyType($key);
            }
            if($this->view === 'truck') {
                $car['carrying'] = getTruckCarrying($key);
            }
            if($this->view === 'bus') {
                $car['capacity'] = getBusCapacity($key);
            }
            $car = (object) $car;
        }
        return $cars;
    }

    // TODO: create data for block parameters
    public function getParametersDrivers() {

        return '';
    }

    public function getParametersCars() {
        return '';
    }

    private function getCarBodyType($id) {
        $bodyType = R::findOne('body_types_cars', ' id = ?', [$id]);
        return isset($bodyType->name) ? $bodyType->name : '';
    }

    private function getCarBrand($id) {
        $carBrand = R::findOne('car_marks', ' id = ?', [$id]);
        return isset($carBrand->name) ? $carBrand->name : '';
    }

    private function getCarModel($id) {
        $carModel = R::findOne('car_models', ' id = ?', [$id]);
        return isset($carModel->name) ? $carModel->name : '';
    }

    private function getTruckCarrying($id) {
        $carrying = R::findOne('carstruck', ' id_car = ?', [$id]);
        return isset($carrying->carrying) ? $carrying->carrying : '';
    }

    private function getBusCapacity($id) {
        $bus = R::findOne('carsbus', ' id_car = ?', [$id]);
        return isset($bus->capacity) ? $bus->capacity : '';
    }
}
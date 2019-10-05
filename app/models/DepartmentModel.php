<?php


namespace app\models;


use RedBeanPHP\R;

class DepartmentModel extends AppModel {
    private $controller;
    private $view;
    private $drivers;
    private $cars;
    private $parametersCars;
    private $parametersDrivers;

    public function __construct($route) {
        $this->controller = $route['controller'];
        $this->view = $route['action'];
        $this->driversInit();
        $this->carsInit();
        $this->parametersDriversInit();
        $this->parametersCarsInit();
    }

    public function getDrivers() {
        return $this->drivers;
    }

    public function getCars() {
        return $this->cars;
    }

    public function getParametersDrivers() {
        return $this->parametersDrivers;
    }

    public function getParametersCars() {
        return $this->parametersCars;
    }

    private function parametersDriversInit() {

        $age_interval = R::getRow('select min(`birthday`) as max, max(`birthday`) as min from drivers where position = ?', ['driver_' . $this->view]);
        $age_interval['min'] = new \DateTime($age_interval['min']);
        $age_interval['max'] = new \DateTime($age_interval['max']);
        $age_interval['min'] = $age_interval['min']->diff(new \DateTime)->y;
        $age_interval['max'] = $age_interval['max']->diff(new \DateTime)->y;

        $work_experience = R::getRow('select min(`date_experience`) as min, max(`date_experience`) as max from drivers where position = ?', ['driver_' . $this->view]);

        $this->parametersDrivers = (object) compact('age_interval', 'work_experience');
    }

    private function parametersCarsInit() {
        $parametersCars = [];
        if($this->view === 'taxi') {
            $bodyTypes = R::getAll(
                'SELECT body_t.name, body_t.name_alias
                        FROM body_types_cars as body_t, carstaxi
                        WHERE body_t.id = carstaxi.id_type_body
                        GROUP BY body_t.name, body_t.name_alias
                        ORDER BY body_t.name'
            );
            $parametersCars['body_types'] = $bodyTypes;
        }

        $colors = [];
        $mileage = ['min' => null, 'max' => 0];
        $year = ['min' => null, 'max' => 0];
        $brands = [];

        foreach($this->cars as $car) {
            if(!empty($car->color)) {
                $colors[] = mb_strtolower($car->color);
            }

            if($mileage['max'] <= $car->mileage) {
                $mileage['max'] = $car->mileage;
            } else if($mileage['min'] >= $car->mileage || $mileage['min'] === null) {
                $mileage['min'] = $car->mileage;
            }

            if($year['max'] <= $car->create_year) {
                $year['max'] = $car->create_year;
            } else if($year['min'] >= $car->create_year || $year['min'] === null) {
                $year['min'] = $car->create_year;
            }
        }

        $parametersCars['colors'] = array_unique($colors);
        $mileage['min'] = $mileage['min'] ? $mileage['min'] : 0;
        $mileage['max'] = $mileage['max'] ? $mileage['max'] : 0;
        $parametersCars['mileage'] = $mileage;
        $parametersCars['year'] = $year;

        $brands = R::getAll('select brand from cars where position = ?', ['car_' . $this->view]);
        foreach($brands as $key => $value) {
            $brands[$key] = $value['brand'];
        }
        $brands = implode(',', array_unique($brands));

        $brands = R::getAll("select * from car_marks where id in (${brands})");

        $parametersCars['brands'] = $brands;


        $this->parametersCars = (object) $parametersCars;
    }

    private function driversInit() {
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
        $this->drivers = $drivers;
    }


    private function carsInit() {
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
        $this->cars = $cars;
    }
}
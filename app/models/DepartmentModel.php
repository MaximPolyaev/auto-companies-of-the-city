<?php


namespace app\models;


use enterprices\Converter;
use RedBeanPHP\R;

class DepartmentModel extends AppModel {
    private $controller;
    private $view;
    private $drivers;
    private $cars;
    private $parametersCars;
    private $parametersDrivers;

    public function __construct($route, $ajax = false) {
        $this->controller = $route['controller'];
        $this->view = $route['action'];
        if(!$ajax) {
            $this->driversInit();
            $this->carsInit();
            $this->parametersDriversInit();
            $this->parametersCarsInit();
        }
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

        $age_interval = R::getRow('select min(`birthday`) as max, max(`birthday`) as min from drivers where position = ?',
            ['driver_' . $this->view]);
        $age_interval['min'] = new \DateTime($age_interval['min']);
        $age_interval['max'] = new \DateTime($age_interval['max']);
        $age_interval['min'] = $age_interval['min']->diff(new \DateTime)->y;
        $age_interval['max'] = $age_interval['max']->diff(new \DateTime)->y;

        $work_experience = R::getRow('select min(`date_experience`) as min, max(`date_experience`) as max from drivers where position = ?',
            ['driver_' . $this->view]);

        $this->parametersDrivers = (object)compact('age_interval', 'work_experience');
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

        if($this->view === 'truck') {
            $carrying = R::getRow(
                'select min(`carrying`) as min, max(`carrying`) as max from carstruck'
            );
            $parametersCars['carrying'] = $carrying;
        }

        if($this->view === 'bus') {
            $capacity = R::getRow(
                'select min(`capacity`) as min, max(`capacity`) as max from carsbus'
            );
            $parametersCars['capacity'] = $capacity;
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


        //debug($parametersCars);

        $this->parametersCars = (object)$parametersCars;
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
            $driver = (object)$driver;
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
            $car = (object)$car;
        }
        $this->cars = $cars;
    }

    public function getCards($data, $typeCards) {
        switch($typeCards) {
            case "taxi" :
                $data = $this->getCarCards($data);
                break;
        }
        return (object)$data;
    }


    private function getCarCards($data) {
        /**
         * TODO: add number flights
         * TODO: add data flights
         */

        // Получаем sql - данные
        $sqlData = $this->getSqlDataCar($data);

        // Создаем sql запрос таблицы машин
        $sqlQueryTableCars = $this->getSqlQueryTableCars($sqlData['select_cars'], $sqlData['type_car']);

        // Инициализация sql запроса
        $sqlQuery = "select * from (${sqlQueryTableCars}) as cars";

        debug($sqlData);

        // sql дополнения и sql параметры
        $sqlQueryAdditions = [];
        $sqlQueryParams = [];

        // Пробег
        $sqlQueryAdditions[] = "mileage >= :milfrom and mileage <= :milto";
        $sqlQueryParams[':milfrom'] = $sqlData['mileage_from'];
        $sqlQueryParams[':milto'] = $sqlData['mileage_to'];

        $sqlQueryAdditions[] = 'and create_year >= :cryaerfrom and create_year <= :cryaerto';
        $sqlQueryParams[':cryaerfrom'] = $sqlData['create_year_from'];
        $sqlQueryParams[':cryaerto'] = $sqlData['create_year_to'];

        // Цвет
        if($sqlData['color'] !== 'no') {
            $sqlQueryAdditions[] = 'and color = :color';
            $sqlQueryParams[':color'] = $sqlData['color'];
        }

        // Дополнение sql запроса
        $sqlQuery .= ' where';
        for($i = 0; $i < count($sqlQueryAdditions); $i++) {
            $add = $sqlQueryAdditions[$i];
            $sqlQuery .= " ${add}";
        }

        //debug($sqlQuery);


        $cars = R::getAll($sqlQuery, $sqlQueryParams);


        debugDBTable($cars);
        return $cars;
    }

    private function getDataSelectCars($cars) {
        function str($arr) {
            if(count($arr) === 1 && $arr[0] === 'no') {
                return 'no';
            } elseif(count($arr) === 1) {
                return "'${arr[0]}'";
            }

            $str = "'";
            foreach($arr as $i => $value) {
                if($i === count($arr) - 1)
                    $str .= "${value}'";
                else
                    $str .= "${value}', '";
            }
            return $str;
        }

        // default array
        $selectCars = [
            'marks' => ['no'],
            'models' => ['no'],
            'cache' => [],
            'all_models' => ['no'],
            'marks_str' => 'no',
            'models_str' => 'no',
            'all_models_str' => 'no'
        ];

        // Если машины не пришли возращаем стандартный массив
        if(count($cars) == 1 && $cars[0] === 'no - no') {
            unset($selectCars['cache']);
            unset($selectCars['marks']);
            unset($selectCars['models']);
            unset($selectCars['all_models']);
            return $selectCars;
        }

        // Добавляем массив всех машин
        for($i = 0; $i < count($cars); $i++) {
            $car = Converter::getFromTo($cars[$i]);

            if($car->from === 'no') continue;

            $selectCars['cache'][$i]['mark'] = $car->from;
            $selectCars['cache'][$i]['model'] = $car->to;
        }

        // Добавляем машины без марок
        unset($selectCars['all_models']);
        foreach($selectCars['cache'] as $car) {
            if($car['model'] === 'no') {
                $selectCars['all_models'][] = $car['mark'];
            }
        }
        if(!isset($selectCars['all_models'])) $selectCars['all_models'] = ['no'];

        // Добавляем марки с моделями
        unset($selectCars['marks']);
        unset($selectCars['models']);
        foreach($selectCars['cache'] as $car) {
            if(!in_array($car['mark'], $selectCars['all_models'])) {
                $selectCars['marks'][] = $car['mark'];
                $selectCars['models'][] = $car['model'];
            }
        }
        if(!isset($selectCars['marks'])) {
            $selectCars['marks'] = ['no'];
            $selectCars['models'] = ['no'];
        }

        // удаляем кэш
        unset($selectCars['cache']);

        // только уникальные значения
        $selectCars['marks'] = array_unique($selectCars['marks']);
        $selectCars['models'] = array_unique($selectCars['models']);
        $selectCars['all_models'] = array_unique($selectCars['all_models']);

        // Инициализируем строки
        $selectCars['marks_str'] = str($selectCars['marks']);
        $selectCars['models_str'] = str($selectCars['models']);
        $selectCars['all_models_str'] = str($selectCars['all_models']);

        // удаляем лишние данные
        unset($selectCars['marks']);
        unset($selectCars['models']);
        unset($selectCars['all_models']);


        return $selectCars;
    }

    private function getSqlQueryTableCars($selectCars, $typeCar) {
        $sqlQueryTableCars = "select cars_old.id as id_car, cars_old.gov_num,
            cars_old.gov_num_alias, cars_old.color,
            cars_old.number_flights, cars_old.create_year,
            cars_old.photo, cars_old.position,
            cars_old.fa_icon, cars_old.repair,
            cars_old.mileage,
            select_car.name_mark, select_car.name_model,
            body_types_cars.name as body_type_name,
            body_types_cars.name_alias as body_type_alias
            from 
                (select marks.id as id_mark, marks.name as name_mark, models.id as id_model, models.name as name_model
                    from car_marks as marks join car_models as models
                           on marks.id = models.id_mark
                    where marks.status = '${typeCar}'";

        if($selectCars['marks_str'] !== 'no' && $selectCars['models_str'] !== 'no') {
            $sqlQueryTableCars .= " and (marks.name_alias in (" . $selectCars['marks_str'] . ")";
            if($selectCars['all_models_str'] !== 'no') {
                $sqlQueryTableCars .= " and models.name_alias in (" . $selectCars['models_str'] . ")";
                $sqlQueryTableCars .= " or marks.name_alias in (" . $selectCars['all_models_str'] . "))";
            } else $sqlQueryTableCars .= " and models.name_alias in (" . $selectCars['models_str'] . "))";
        } elseif($selectCars['marks_str'] === 'no') {
            if($selectCars['all_models_str'] !== 'no') {
                $sqlQueryTableCars .= " and marks.name_alias in (" . $selectCars['all_models_str'] . ")";
            } else $sqlQueryTableCars .= '';
        }
        $sqlQueryTableCars .= ") as select_car join cars as cars_old
                on select_car.id_mark = cars_old.brand and select_car.id_model = cars_old.model
            join carstaxi
                on carstaxi.id_car = cars_old.id
            join body_types_cars
                on body_types_cars.id = carstaxi.id_type_body";

        return $sqlQueryTableCars;
    }

    private function getSqlDataCar($data) {
        $sqlData = [];

        // Проверка: пришли данные?
        if(!(
            isset($data['typecar']) &&
            isset($data['bodytype']) &&
            isset($data['color']) &&
            isset($data['mileage']) &&
            isset($data['flights']) &&
            isset($data['dateflightfrom']) &&
            isset($data['dateflightto']) &&
            isset($data['year']) &&
            isset($data['cars'])
        )) {
            die;
        }

        // Тип машины: грузовик или такси или автобус
        $sqlData['type_car'] = $data['typecar'];

        // Тип кузова
        $sqlData['bodytype'] = $data['bodytype'];

        // Цвет машины
        $sqlData['color'] = $data['color'];

        // Пробег машины
        $mileage = Converter::getFromTo($data['mileage']);
        $sqlData['mileage_from'] = isset($mileage->from) ? (int)$mileage->from : 0;
        $sqlData['mileage_to'] = isset($mileage->to) ? (int)$mileage->to : 0;

        // Количество маршрутов
        $flights = Converter::getFromTo($data['flights']);
        $sqlData['flights_from'] = isset($flights->from) ? (int)$flights->from : 0;
        $sqlData['flights_to'] = isset($flights->to) ? (int)$flights->to : 0;

        // Дата маршрута
        $sqlData['date_flight_from'] = isset($data['dateflightfrom']) ? Converter::toDbDate($data['dateflightfrom']) : date('Y-m-d');
        $sqlData['date_flight_to'] = isset($data['dateflightto']) ? Converter::toDbDate($data['dateflightto']) : date('Y-m-d');

        // Дата года выпуска машины
        $createYear = Converter::getFromTo($data['year']);
        $sqlData['create_year_from'] = isset($createYear->from) ? (int)$createYear->from : 0;
        $sqlData['create_year_to'] = isset($createYear->to) ? (int)$createYear->to : 0;

        // Выбранные машины
        $sqlData['select_cars'] = $this->getDataSelectCars($data['cars']);

        return $sqlData;
    }
}

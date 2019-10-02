<?php


namespace app\controllers;


use app\models\AddCarModel;
use enterprices\SessionData;
use RedBeanPHP\R;

class AddCarController extends AppController {
    private $sessionErrKey = 'err_add_car_modal';
    private $session;
    private $addCar;
    private $errorList = [];

    public function __construct($route) {
        parent::__construct($route);
        $this->addCar = new AddCarModel();
        $this->session = SessionData::instance();
    }

    public function taxiAction() {
        $this->render();
    }

    public function render() {
        if($this->addCar->dataInit()) {
            $data = $this->addCar->getData();
            $this->dataSend($data);
        } else {
            $this->errorList = $this->addCar->getErrorList();
            $this->session->setSessionDataKey($this->sessionErrKey, $this->errorList);
            redirect();
        }
    }

    public function truckAction() {
        $this->render();
    }

    public function busAction() {
        $this->render();
    }

    // TASK: create method dataSend
    private function dataSend($data) {
        $cars = R::dispense('cars');
        $carsColumns = $this->getTableColumns('cars');

        foreach($data as $key => $value) {
            $regexp = '/' . $key . '/iu';
            if(!preg_match($regexp, $carsColumns)) {
                continue;
            }
            $cars->$key = $value;
        }


        R::begin();
        try {
            R::store($cars);
            if(isset($data['id_type_body'])) {
                $car_id = (R::findOne('cars', ' gov_num_alias = ?', [$data['gov_num_alias']]))->id;
                $cars_taxi = R::dispense('carstaxi');
                $cars_taxi->id_car = $car_id;
                $cars_taxi->id_type_body = $data['id_type_body'];
                R::store($cars_taxi);
            }
            if(isset($data['carrying'])) {
                $car_id = (R::findOne('cars', ' gov_num_alias = ?', [$data['gov_num_alias']]))->id;
                $cars_truck = R::dispense('carstruck');
                $cars_truck->id_car = $car_id;
                $cars_truck->carrying = $data['carrying'];
                R::store($cars_truck);
            }
            if(isset($data['capacity'])) {
                $car_id = (R::findOne('cars', ' gov_num_alias = ?', [$data['gov_num_alias']]))->id;
                $cars_bus = R::dispense('carsbus');
                $cars_bus->id_car = $car_id;
                $cars_bus->capacity = $data['capacity'];
                R::store($cars_bus);
            }
            R::commit();
        } catch(\Exception $e) {
            R::rollback();
            $this->errorMessage($e);
        }
        $this->session->clearSessionDataKey($this->sessionErrKey);
        redirect($this->addCar->getPrevPage());
    }

    // TASK: edit method errorMessage
    private function errorMessage($e) {
        if(DEBUG) {
            echo "<h4>Ошибка! {$e->getMessage()}</h4>";
            die;
        } else {
            $this->errorList = $this->addDriver->getErrorList();
            $this->errorList['errors'][] = 'Сервер временно не работает. Попробуйте позже!';
            $this->session->setSessionDataKey($this->sessionErrKey, $this->errorList);
            redirect($this->addDriver->getPrevPage());
        }
    }

    private function getTableColumns($table) {
        $columns = '';
        $table = R::getAll('DESCRIBE ' . $table);
        foreach($table as $column) {
            $columns .= $column['Field'] . ' ';
        }
        return $columns;
    }
}
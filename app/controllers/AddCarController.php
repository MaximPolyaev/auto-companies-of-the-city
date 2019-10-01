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
        if($this->addCar->dataInit()) {
            $data = $this->addCar->getData();
            redirect($this->addCar->getPrevPage());
//            $this->dataSend($data);
        } else {
            $this->errorList = $this->addCar->getErrorList();
            $this->session->setSessionDataKey($this->sessionErrKey, $this->errorList);
            redirect($this->addCar->getPrevPage());
        }
    }

    public function truckAction() {
        redirect();
    }

    public function busAction() {
        redirect();
    }

    // TASK: create method dataSend
//    private function dataSend($data) {
//        $table = R::dispense($this->tableName);
//
//        foreach($data as $key => $value) {
//            $table->$key = $value;
//        }
//
//        R::begin();
//        try {
//            R::store($table);
//            R::commit();
//        } catch(\Exception $e) {
//            R::rollback();
//            $this->errorMessage($e);
//        }
//        $this->session->clearSessionDataKey($this->sessionErrKey);
//        redirect($this->addDriver->getPrevPage());
//    }

    // TASK: edit method errorMessage
//    private function errorMessage($e) {
//        if(DEBUG) {
//            echo "<h4>Ошибка! {$e->getMessage()}</h4>";
//            die;
//        } else {
//            $this->errorList = $this->addDriver->getErrorList();
//            $this->errorList['errors'][] = 'Сервер временно не работает. Попробуйте позже!';
//            $this->session->setSessionDataKey($this->sessionErrKey, $this->errorList);
//            redirect($this->addDriver->getPrevPage());
//        }
//    }
}
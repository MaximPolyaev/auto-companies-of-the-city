<?php


namespace app\controllers;


use app\models\AddDriverModel;
use enterprices\SessionData;
use RedBeanPHP\R;

class AddDriverController extends AppController {
    private $tableName = 'drivers';
    private $sessionErrKey = 'err_add_driver_modal';
    private $session;
    private $addDriver;
    private $errorList;

    public function __construct($route) {
        parent::__construct($route);
        $this->addDriver = new AddDriverModel();
        $this->session = SessionData::instance();
    }

    public function taxiAction() {
        if($this->addDriver->dataInit()) {
            $data = $this->addDriver->getData();
            $this->dataSend($data);
        } else {
            $this->errorList = $this->addDriver->getErrorList();
            $this->session->setSessionDataKey($this->sessionErrKey, $this->errorList);
            redirect($this->addDriver->getPrevPage());
        }
    }

    public function truckAction() {
        if($this->addDriver->dataInit()) {
            $data = $this->addDriver->getData();
            $this->dataSend($data);
        } else {
            $this->errorList = $this->addDriver->getErrorList();
            $this->session->setSessionDataKey($this->sessionErrKey, $this->errorList);
            redirect($this->addDriver->getPrevPage());
        }
    }

    public function busAction() {
        if($this->addDriver->dataInit()) {
            $data = $this->addDriver->getData();
            $this->dataSend($data);
        } else {
            $this->errorList = $this->addDriver->getErrorList();
            $this->session->setSessionDataKey($this->sessionErrKey, $this->errorList);
            redirect($this->addDriver->getPrevPage());
        };
    }

    private function dataSend($data) {
        $table = R::dispense($this->tableName);

        foreach($data as $key => $value) {
            $table->$key = $value;
        }

        R::begin();
        try {
            R::store($table);
            R::commit();
        } catch(\Exception $e) {
            R::rollback();
            $this->errorMessage($e);
        }
        $this->session->clearSessionDataKey($this->sessionErrKey);
        redirect($this->addDriver->getPrevPage());
    }

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
}
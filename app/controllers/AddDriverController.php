<?php


namespace app\controllers;


use app\models\AddDriverModel;
use enterprices\SessionData;
use RedBeanPHP\R;

class AddDriverController extends AppController {
    protected $session;
    protected $prevController;
    protected $prevAction;

    public function __construct($route) {
        parent::__construct($route);
        $addDriver = new AddDriverModel();
        $this->session = SessionData::instance();
        $prevPage = $_SERVER['HTTP_REFERER'] ?? '';
        $regexp = '/(?P<controller>[a-z]+)\/(?P<action>[a-z0-9]+)$/iu';
        preg_match($regexp, $prevPage, $matches);
        $this->prevController = isset($matches['controller']) ? $matches['controller'] : '';
        $this->prevAction = isset($matches['action']) ? $matches['action'] : '';
    }

    public function taxiAction() {
        $addError = [
            'controller' => $this->prevController,
            'action' => $this->prevAction
        ];
        $drivers = R::dispense('drivers');
        $drivers->surname = $_GET['surname'];
        $drivers->name = $_GET['name'];
        $drivers->patronymic = $_GET['patronymic'];
        $drivers->birthday = $_GET['ageuser'];
        $drivers->date_experience = $_GET['experience'];
        $drivers->number_phone = $_GET['phone'];
        $drivers->address = $_GET['address'];
        $drivers->position = 'driver_taxid';
        $drivers->gender = isset($_GET['gender']) ? $_GET['gender'] : '';


        R::begin();
        try {
            R::store($drivers);
            R::commit();
        } catch(\Exception $e) {
            R::rollback();
            if(!DEBUG) {
                echo "<h4>Ошибка! {$e->getMessage()}</h4>";
            } else {
                $addError['errors'][] = 'Сервер временно не работает. Попробуйте позже!';
                $this->session->setSessionDataKey('err_modal', $addError);
                redirect();
            }
        }
        $this->session->clearSessionDataKey('err_modal');
        redirect();
    }

    public function truckAction() {
        redirect();
    }

    public function busAction() {
        redirect();
    }
}
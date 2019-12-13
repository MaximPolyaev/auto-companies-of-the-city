<?php

namespace app\models;


use enterprices\App;
use enterprices\Converter;
use enterprices\Validator;

class AddDriverModel extends AppModel {
    private $prevPage;
    private $prevRouting;
    private $data;
    private $errorList = [];
    private $modalPages = [];

    public function __construct() {
        $this->modalPages = App::$app->getProperty('add_modal_pages');
        $this->prevPage = $_SERVER['HTTP_REFERER'] ?? '';
        $this->prevRouting = self::getPrevRouting($this->prevPage);
    }

    public function dataInit() {
        $this->errorListInit();
        if(isset($this->errorList['errors'])) {
            return false;
        }

        if(Validator::isPosition($this->prevRouting['action'])) {
            $this->data['position'] = 'driver_' . $this->prevRouting['action'];
        } else {
            $this->errorList['errors'][] = 'Запрос был отправлен некорректно';
        }

        if(isset($_GET['surname']) && !empty($_GET['surname'])) {
            $this->data['surname'] = $_GET['surname'];
        } else {
            $this->errorList['errors'][] = 'Вы забыли ввести фамилию';
        }

        if(isset($_GET['name']) && !empty($_GET['name'])) {
            $this->data['name'] = $_GET['name'];
        } else {
            $this->errorList['errors'][] = 'Вы забыли ввести имя';
        }

        if(isset($_GET['patronymic']) && !empty($_GET['patronymic'])) {
            $this->data['patronymic'] = $_GET['patronymic'];
        } else {
            $this->errorList['errors'][] = 'Вы забыли ввести отчество';
        }

        if(Validator::isDate(isset($_GET['birthday']) ? $_GET['birthday'] : '')) {
            $this->data['birthday'] = Converter::toDbDate($_GET['birthday']);
        } else {
            $this->errorList['errors'][] = 'Дата введена некорректно';
        }

        if(Validator::isGender(isset($_GET['gender']) ? $_GET['gender'] : '')) {
            $this->data['gender'] = $_GET['gender'];
        } else {
            $this->errorList['errors'][] = 'Выбирите пол';
        }

        if(Validator::isWorkExperience(isset($_GET['experience']) ? $_GET['experience'] : '')) {
            $this->data['date_experience'] = $_GET['experience'];
        } else {
            $this->errorList['errors'][] = 'Стаж работы введен некорректно';
        }

        if(Validator::isPhone(isset($_GET['phone']) ? $_GET['phone'] : '')) {
            $this->data['number_phone'] = Converter::toDbPhone($_GET['phone']);
        } else {
            $this->errorList['errors'][] = 'Введен некоректный номер телефона';
        }

        if(isset($_GET['address']) && !empty($_GET['address'])) {
            $this->data['address'] = $_GET['address'];
        } else {
            $this->errorList['errors'][] = 'Вы забыли ввести адрес';
        }

        if(isset($this->errorList['errors'])) {
            return false;
        }

        return true;
    }

    public function getData() {
        return $this->data;
    }

    public function getErrorList() {
        return $this->errorList;
    }

    public function getPrevPage() {
        return $this->prevPage;
    }

    private function errorListInit() {
        $this->errorList = [
            'controller' => $this->prevRouting['controller'] ?? '',
            'action' => $this->prevRouting['action'] ?? ''
        ];

        foreach($this->modalPages as $modalPage) {
            if($modalPage['controller'] === $this->errorList['controller'] &&
                $modalPage['action'] === $this->errorList['action']) {
                return;
            }
        }

        $this->errorList['errors'][] = 'Запрос был отправлен некорректно';
    }
}
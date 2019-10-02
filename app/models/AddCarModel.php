<?php


namespace app\models;


use enterprices\App;
use enterprices\Validator;

class AddCarModel extends AppModel {
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
            $this->data['position'] = 'car_' . $this->prevRouting['action'];
            $this->data['fa_icon'] = 'fa-' . ($this->prevRouting['action'] === 'taxi' ? 'car' : $this->prevRouting['action']);
        } else {
            $this->errorList['errors'][] = 'Запрос был отправлен некорректно';
        }

        if(Validator::isGovNum(isset($_GET['govnum']) ? $_GET['govnum'] : '')) {
            $this->data['gov_num'] = mb_strtolower($_GET['govnum']);
            $this->data['gov_num_alias'] = rus_translate(mb_strtolower($_GET['govnum']));
        } else {
            $this->errorList['errors'][] = 'Гос номер был введен некорректно';
        }

        if($mark = Validator::isMark(isset($_GET['mark']) ? $_GET['mark'] : '')) {
            $this->data['brand'] = $mark->id;
        } else {
            $this->errorList['errors'][] = 'Вы не выбрали марку машину';
        }

        if($model = Validator::isModel(
            isset($this->data['brand']) ? $this->data['brand'] : '',
            isset($_GET['model'])? $_GET['model'] : ''
        )) {
            $this->data['model'] = $model->id;
        } else {
            $this->errorList['errors'][] = 'Вы не выбрали модель машины';
        }

        if('car_taxi' === (isset($this->data['position']) ? $this->data['position'] : '')) {
            if($bodyType = Validator::isBodyType(
                isset($_GET['bodytype']) ? $_GET['bodytype'] : ''
            )) {
                $this->data['id_type_body'] = $bodyType->id;
            } else {
                $this->errorList['errors'][] = 'Вы не выбрали тип кузова машины';
            }
        } else if('car_truck' === (isset($this->data['position']) ? $this->data['position'] : '')) {
            if(Validator::isNumber(
                isset($_GET['carrying']) ? $_GET['carrying'] : '', 1, 2
            )) {
                $this->data['carrying'] = $_GET['carrying'];
            } else {
                $this->errorList['errors'][] = 'Вы не определили грузоподъемность машины';
            }
        } else if('car_bus' === (isset($this->data['position']) ? $this->data['position'] : '')) {
            if(Validator::isNumber(
                isset($_GET['capacity']) ? $_GET['capacity'] : '', 1, 2
            )) {
                $this->data['capacity'] = $_GET['capacity'];
            } else {
                $this->errorList['errors'][] = 'Вы не определили вместительность автобуса';
            }
        }

        if(isset($_GET['color'])) {
            $this->data['color'] = $_GET['color'];
        } else {
            $this->data['color'] = null;
        }

        if(Validator::isNumber(isset($_GET['year']) ? $_GET['year'] : '', 4)) {
            $this->data['create_year'] = $_GET['year'];
        } else {
            $this->errorList['errors'][] = 'Вы не выбрали тип кузова машины';
        }

        if(Validator::isNumber(isset($_GET['mileage']) ? $_GET['mileage'] : '', 1, 10)) {
            $this->data['mileage'] = $_GET['mileage'];
        } else {
            $this->errorList['errors'][] = 'Вы не ввели пробег машины, или данные были введены некорректно';
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
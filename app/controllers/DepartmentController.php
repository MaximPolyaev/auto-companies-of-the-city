<?php


namespace app\controllers;

use app\models\DepartmentModel;
use app\widgets\add\car\AddModalCar;
use app\widgets\add\driver\AddModalDriver;
use enterprices\App;
use RedBeanPHP\R;

class DepartmentController extends AppController {
    private $departmentModel;

    public function __construct($route) {
        parent::__construct($route);
        // Initialize car body types
        App::$app->setProperty('body_types_cars', self::cacheBodyTypesCar());
        $this->departmentModel = new DepartmentModel($this->route);

        // drivers and cars
        $drivers = $this->departmentModel->getDrivers();
        $cars = $this->departmentModel->getCars();
        $parametersDrivers = $this->departmentModel->getParametersDrivers();
        $parametersCars = $this->departmentModel->getParametersCars();
        $this->set(compact('drivers', 'cars', 'parametersDrivers', 'parametersCars'));

        // Route Modifier Rendering for page split
        if(isset($this->route['modificator'])) {
            $modificator = $this->route['modificator'];
            $this->set(compact('modificator'));
        }

        // if isAjax query
        if(!$this->isAjax()) {
            debug('isAjax');
            die;
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
}
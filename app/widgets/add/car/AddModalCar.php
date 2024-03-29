<?php


namespace app\widgets\add\car;


use enterprices\App;
use enterprices\SessionData;
use RedBeanPHP\R;

class AddModalCar {
    private $sessionErrKey = 'err_add_car_modal';
    protected $session;
    protected $controller;
    protected $action;
    protected $status;
    protected $tpl;
    protected $data = [];

    public function __construct($route, $status = '') {
        $this->tpl = __DIR__ . '/car_tpl/car.php';

        $this->session = SessionData::instance();

        $this->controller = $route['controller'] ?? null;
        $this->action = $route['action'] ?? null;
        if(!$status && $this->controller === 'Department' && $this->action) {
            $this->status = $this->action;
        } else if(!($status === 'taxi' || $status === 'truck' || $status === 'bus')) {
            throw new \Exception("Modal status: $status not initialized", 404);
        } else {
            $this->status = $status;
        }

        $this->data['id'] = 'add_car_' . $this->status;
        $this->data['html'] = $this->getModalHtml();
    }

    public function getData() {
        return (object) $this->data;
    }

    protected function getTitleModal() {
        $title = 'Добавление';
        if($this->status === 'taxi') {
            $title .= ' машины такси';
            $faIconModal = 'fa-car';
        } else if($this->status === 'truck') {
            $title .= ' грузовика';
            $faIconModal = 'fa-truck';
        } else if($this->status === 'bus') {
            $title .= ' автобуса';
            $faIconModal = 'fa-bus';
        } else {
            $title .= ' машины';
        }
        return $title;
    }

    protected function getFaIconModal() {
        $faIcon = '';
        if($this->status === 'taxi') {
            $faIcon = 'fa-car';
        } else if($this->status === 'truck') {
            $faIcon = 'fa-truck';
        } else if($this->status === 'bus') {
            $faIcon = 'fa-bus';
        }
        return $faIcon;
    }

    protected function getCarMarks() {
        return R::findAll('car_marks', 'WHERE status = ?', [$this->status]);
    }

    protected function getErrorsModal() {
        $sessionData = $this->session->getSessionDataKey($this->sessionErrKey) ?? '';
        if(!isset($sessionData['errors'])) {
            return [];
        }

        $pageController = mb_strtolower($this->controller, 'UTF-8');
        $pageAction = $this->action;
        $errController = isset($sessionData['controller']) ? $sessionData['controller'] : '';
        $errAction = isset($sessionData['action']) ? $sessionData['action'] : '';

        if($pageController === $errController && $pageAction === $errAction) {
            $this->session->clearSessionDataKey($this->sessionErrKey);
            return $sessionData['errors'];
        }

        return [];
    }

    protected function getModalHtml() {
        $id = $this->data['id'];
        $status = $this->status;
        $title = $this->getTitleModal();
        $faIcon = $this->getFaIconModal();
        $bodyTypesCars = [];
        foreach(App::$app->getProperty('body_types_cars') as $value) {
            $bodyTypesCars[] = (object) $value;
        }
        $carMarks = $this->getCarMarks();
        $errors = $this->getErrorsModal();

        ob_start();
        require $this->tpl;
        return ob_get_clean();
    }
}
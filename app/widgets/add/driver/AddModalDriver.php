<?php


namespace app\widgets\add\driver;


use enterprices\SessionData;

class AddModalDriver {
    protected $controller;
    protected $session;
    protected $action;
    protected $status;
    protected $tpl;
    protected $data = [];

    public function __construct($route, $status = '') {
        $this->tpl = __DIR__ . '/driver_tpl/driver.php';

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

        $this->data['id'] = 'add_driver_' . $this->status;
        $this->data['html'] = $this->getModalHtml();
    }

    public function getData() {
        return (object) $this->data;
    }

    protected function getTitleModal() {
        $title = 'Добавление водителя';
        if($this->status === 'taxi') {
            $title .= ' такси';
        } else if($this->status === 'truck') {
            $title .= ' грузовика';
        } else if($this->status === 'bus') {
            $title .= ' автобуса';
        }
        return $title;
    }

    protected function getErrorsModal() {
        $sessionData = $this->session->getSessionDataKey('err_modal') ?? '';
        if(!isset($sessionData['errors'])) {
            return [];
        }

        $pageController = mb_strtolower($this->controller, 'UTF-8');
        $pageAction = $this->action;
        $errController = isset($sessionData['controller']) ? $sessionData['controller'] : '';
        $errAction = isset($sessionData['action']) ? $sessionData['action'] : '';

        if($pageController === $errController && $pageAction === $errAction) {
            $this->session->clearSessionDataKey('err_modal');
            return $sessionData['errors'];
        }

        return [];
    }

    protected function getModalHtml() {
        $id = $this->data['id'];
        $status = $this->status;
        $title = $this->getTitleModal();
        $errors = $this->getErrorsModal();

        ob_start();
        require $this->tpl;
        return ob_get_clean();
    }
}
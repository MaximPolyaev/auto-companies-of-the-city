<?php


namespace app\controllers;


class SettingsController extends AppController {
    public function __construct($route) {
        parent::__construct($route);
    }

    public function indexAction() {
        if($this->isAjax()) {
            debug($_GET);
            require APP . "/views/{$this->controller}/ajax.php";
            die;
        }
    }
}
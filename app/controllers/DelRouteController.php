<?php


namespace app\controllers;


use RedBeanPHP\R;

class DelRouteController extends AppController {
    public function __construct($route) { parent::__construct($route); }

    public function indexAction() {
        $route = R::findOne('busroutes', ' name_alias = ?', [isset($_GET['name']) ? $_GET['name'] : '']);
        R::trash($route);
        redirect(PATH . '/department/bus/routes');
    }
}
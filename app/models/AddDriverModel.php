<?php


namespace app\models;


use enterprices\base\View;
use enterprices\SessionData;
use enterprices\Validator;

class AddDriverModel extends AppModel {
    private $session;
    private $prevPage;
    private $prevRouting;
    private $errorList = [];
    private $data;
    private $modalPages = [
        0 => [
            'controller' => 'department',
            'action' => 'taxi',
        ],
        1 => [
            'controller' => 'department',
            'action' => 'truck',
        ],
        2 => [
            'controller' => 'department',
            'action' => 'bus'
        ]
    ];

    public function __construct() {
        $this->session = SessionData::instance();
        $this->prevPage = $_SERVER['HTTP_REFERER'] ?? '';
        $this->prevRouting = $this->getPrevRouting();
    }

    public function dataInit() {
        $this->errorListInit();
        if(isset($this->errorList['errors'])) {
            return false;
        }


        if(Validator::checkDriverPosition($this->prevRouting['action'])) {
            $this->data['position'] = 'driver_' . $this->prevRouting['action'];
        } else {
            $this->errorList['errors'][] = 'Запрос был отправлен некорректно';
        }

        if(Validator::checkPhone($_GET['phone'])) {
            $this->data['phone'] = $_GET['phone'];
        } else {
            $this->errorList['errors'][] = 'Введен некоректный номер телефоа';
        }

        debug($this->errorList);

        return true;
    }

    private function getPrevRouting() {
        $regexp = '/(?P<controller>[a-z]+)\/(?P<action>[a-z0-9]+)$/iu';
        preg_match($regexp, $this->prevPage, $matches);
        $prevController = isset($matches['controller']) ? $matches['controller'] : '';
        $prevAction = isset($matches['action']) ? $matches['action'] : '';
        return [
            'controller' => $prevController,
            'action' => $prevAction
        ];
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
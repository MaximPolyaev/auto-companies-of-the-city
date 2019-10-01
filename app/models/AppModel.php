<?php


namespace app\models;


use enterprices\base\Model;

class AppModel extends Model {

    public static function getPrevRouting($prevPage) {
        $regexp = '/(' . MAIN_PAGE . ')\/(?P<controller>[a-z]+)\/(?P<action>[a-z0-9]+)?/iu';
        preg_match($regexp, $prevPage, $matches);
        $prevController = isset($matches['controller']) ? $matches['controller'] : '';
        $prevAction = isset($matches['action']) ? $matches['action'] : '';
        return [
            'controller' => $prevController,
            'action' => $prevAction
        ];
    }
}
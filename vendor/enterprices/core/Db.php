<?php


namespace enterprices;



use RedBeanPHP\R;

class Db {
    use TSingleton;
    protected function __construct() {
        $db = require_once CONF . '/config_database.php';
        R::setup($db['dsn'], $db['user'], $db['pass']);
        if($db['freeze']) {
            R::freeze(TRUE);
        }
        if(!R::testConnection()) {
            throw new \Exception('Database not connect', 404);
        }
        if(DEBUG) {
            R::debug(true, 1);
        }
    }
}
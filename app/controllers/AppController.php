<?php


namespace app\controllers;


use app\models\AppModel;
use enterprices\App;
use enterprices\base\Controller;
use enterprices\Cache;
use RedBeanPHP\R;

class AppController extends Controller {
    public function __construct($route) {
        parent::__construct($route);
        new AppModel();
        App::$app->setProperty('cats', self::cacheCategory());
    }

    public static function cacheCategory() {
        $cache = Cache::instance();
        $cats = $cache->get('cats');
        if(!$cats) {
            $cats = R::getAssoc('SELECT * FROM menu');
            $cache->set('cats', $cats);
        }
        return $cats;
    }

    public static function cacheBodyTypesCar() {
        $cache = Cache::instance();
        $bodyTypes = $cache->get('body_types');
        if(!$bodyTypes) {
            $bodyTypes = R::getAssoc('SELECT * FROM body_types_cars');
            $cache->set('body_types', $bodyTypes);
        }
        return $bodyTypes;
    }
}
<?php


namespace enterprices\base;


use enterprices\Db;

abstract class Model {
    public $attributes = [];
    public $errors = [];
    public $rules = [];

    public function __construct() {
        Db::instance();
    }
}
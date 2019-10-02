<?php


namespace enterprices;


use RedBeanPHP\R;

class Validator {
    public static function isPhone($phone) {
        $regexp = '/^\+7\s\(\d{3}\)\s\d{3}-\d{2}-\d{2}$/iu';
        return preg_match($regexp, $phone);
    }

    public static function isPosition($position) {
        $regexp = '/^((taxi)|(truck)|(bus))$/iu';
        return (preg_match($regexp, $position));
    }

    public static function isDate($date) {
        $regexp = '/^\d{2}-\d{2}-\d{4}$/iu';
        return preg_match($regexp, $date);
    }

    public static function isGender($gender) {
        $regexp = '/^((male)|(female))$/iu';
        return preg_match($regexp, $gender);
    }

    public static function isWorkExperience($number) {
        $regexp = '/^\d{1,2}$/iu';
        return preg_match($regexp, $number);
    }

    public static function isGovNum($number) {
        $regexp = '/^\D\d{3}\D{2}\d{2,3}$/iu';
        return preg_match($regexp, $number);
    }

    public static function isMark($mark) {
        return R::findOne('car_marks', ' name_alias = ?', [$mark]);
    }

    public static function isModel($mark_id, $model) {
        return R::findOne('car_models', ' id_mark = ? and name_alias = ?', [$mark_id, $model]);
    }

    public static function isBodyType($type) {
        return R::findOne('body_types_cars', ' name_alias = ?', [$type]);
    }

    public static function isNumber($number, $sz, $sz_max = null) {
        $interval = $sz . ($sz_max ? ',' . $sz_max : '');
        $regexp = '/^\d{' . $interval . '}$/iu';
        return preg_match($regexp, $number);
    }
}
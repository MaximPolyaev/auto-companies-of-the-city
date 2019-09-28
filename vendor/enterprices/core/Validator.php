<?php


namespace enterprices;


class Validator {
    static function checkPhone($phone) {
        $regexp = '/^\+7\s\(\d{3}\)\s\d{3}-\d{2}-\d{2}$/iu';
        if(preg_match($regexp, $phone))
            return true;
        return false;
    }

    static function checkDriverPosition($position) {
        $regexp = '/^((taxi)|(truck)|(bus))$/iu';
        if(preg_match($regexp, $position))
            return true;
        return false;
    }
}
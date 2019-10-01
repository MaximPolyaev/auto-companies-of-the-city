<?php


namespace enterprices;


class Validator {
    public static function checkPhone($phone) {
        $regexp = '/^\+7\s\(\d{3}\)\s\d{3}-\d{2}-\d{2}$/iu';
        return preg_match($regexp, $phone);
    }

    public static function checkDriverPosition($position) {
        $regexp = '/^((taxi)|(truck)|(bus))$/iu';
        return (preg_match($regexp, $position));
    }

    public static function checkDateFormat($date) {
        $regexp = '/^\d{2}-\d{2}-\d{4}$/iu';
        return preg_match($regexp, $date);
    }

    public static function checkGender($gender) {
        $regexp = '/^((male)|(female))$/iu';
        return preg_match($regexp, $gender);
    }

    public static function checkWorkExperience($number) {
        $regexp = '/^\d{1,2}$/iu';
        return preg_match($regexp, $number);
    }
}
<?php


namespace enterprices;


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

    public static function isYear($year) {
        $regexp = '/^\d{4}$/iu';
        return preg_match($regexp, $year);
    }
}
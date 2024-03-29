<?php


namespace enterprices;


class Converter {
    public static function toDbDate($date) {
        $regexp = '/^(\d{2})-(\d{2})-(\d{4})$/iu';
        $replacement = '${3}-${2}-${1}';
        return preg_replace($regexp, $replacement, $date);
    }

    public static function toDbPhone($phone) {
        $regexp = '/^\+7\s\((\d{3})\)\s(\d{3})-(\d{2})-(\d{2})$/iu';
        $replacement = '7${1}${2}${3}${4}';
        return preg_replace($regexp, $replacement, $phone);
    }

    public static function getFromTo($string) {
        $regexp = '/^(?P<from>\w+)\s-\s(?P<to>\w+)$/iu';
        preg_match($regexp, $string, $matches);
        return (object) $matches;
    }
}
<?php


namespace enterprices;


class Registry {
    use TSingleton;

    protected static $properties = [];

    public function setProperty($key, $value) {
        self::$properties[$key] = $value;
    }

    public function getProperty($key) {
        if(isset(self::$properties[$key])) {
            return self::$properties[$key];
        }
        return null;
    }

    public function getProperties() {
        return self::$properties;
    }
}
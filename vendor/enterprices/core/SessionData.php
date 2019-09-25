<?php


namespace enterprices;


class SessionData {
    use TSingleton;

    public function getSesstionDataAll() {
        return $_SESSION;
    }

    public function getSessionDataKey($key) {
        if(isset($_SESSION[$key])) {
            return $_SESSION[$key];
        }
        return false;
    }

    public function setSessionDataKey($key, $value) {
        $_SESSION[$key] = $value;
    }

    public function clearSessionDataAll() {
        session_destroy();
    }

    public function clearSessionDataKey($key) {
        unset($_SESSION[$key]);
    }
}
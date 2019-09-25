<?php


namespace enterprices;


class ErrorHandler {
    public function __construct() {
        if(DEBUG) {
            error_reporting(-1);
        } else {
            error_reporting(0);
        }
        set_exception_handler([$this, 'exceptionHandler']);
    }

    public function exceptionHandler($e) {
        $this->logErrors($e->getMessage(), $e->getFile(), $e->getLine());
        $this->displayError('Exception', $e->getMessage(), $e->getFile(), $e->getLine(), $e->getCode());
    }

    protected function logErrors($msg = '', $file = '', $line = '') {
        error_log('[' . date('Y-m-d H:m:s') . '] Text error: ' . $msg . '| File: ' . $file . '| Line: ' . $line .
        "\n==================\n", 3, ROOT . '/tmp/errors.log');
    }

    protected function displayError($err_number, $err_str, $err_file, $err_line, $response = 404) {
        http_response_code($response);
        if($response == 404 && !DEBUG) {
            require WWW . '/errors/404.php';
            die;
        }
        if(DEBUG) {
            require WWW . '/errors/dev.php';
            die;
        } else {
            require WWW . '/errors/prod.php';
            die;
        }
    }
}
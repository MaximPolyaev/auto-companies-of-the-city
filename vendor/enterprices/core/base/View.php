<?php


namespace enterprices\base;


class View {
    public $route;
    public $controller;
    public $view;
    public $model;
    public $layout;
    public $data = [];
    public $meta = [];

    public function __construct($route, $layout = '', $view = '', $meta) {
        $this->route = $route;
        $this->controller = $route['controller'];
        $this->view = $view;
        $this->model = $route['controller'];
        $this->meta = $meta;

        if($layout === false) {
            $this->layout = false;
        } else {
            $this->layout = $layout ?: LAYOUT;
        }
    }

    public function render($data) {
        if(is_array($data)) {
            foreach($data as $var) {
                if(is_array($var)) extract($var);
            }
        }
        $viewFile = APP . "/views/{$this->controller}/{$this->view}.php";
        if(is_file($viewFile)) {
            ob_start();
            require_once $viewFile;
            $content = ob_get_clean();
        } else {
            throw new \Exception("View $viewFile not found", 404);
        }

        if($this->layout !== false) {
            $layoutFile = APP . "/views/layouts/{$this->layout}.php";
            if(is_file($layoutFile)) {
                require_once $layoutFile;
            } else {
                throw new \Exception("Layout $this->layout not found", 404);
            }
        }
    }

    public function getMeta() {
        $outputHTML = '<title>' . $this->meta['title'] . '</title>' . PHP_EOL;
        $outputHTML .= '<meta name="description" content="' . $this->meta['desc'] . '">' . PHP_EOL;
        $outputHTML .= '<meta name="keywords" content="' . $this->meta['keywords'] . '">' . PHP_EOL;
        return $outputHTML;
    }
}
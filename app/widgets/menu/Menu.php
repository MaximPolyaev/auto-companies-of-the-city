<?php


namespace app\widgets\menu;


use enterprices\App;
use enterprices\Cache;
use RedBeanPHP\R;

class Menu {
    protected $data;
    protected $route;
    protected $tree;
    protected $menuHtml;
    protected $tpl;
    protected $container = 'ul';
    protected $table = 'menu';
    protected $cache = '3600';
    protected $cacheKey;
    protected $attrs = [];
    protected $prepend = '';

    public function __construct($options = []) {
        $this->route = new \stdClass();
        $this->tpl = __DIR__ . '/menu_tpl/menu.php';
        $this->getOptions($options);
        $this->run();
    }

    protected function getOptions($options) {
        foreach($options as $key => $value) {
            if($key === 'controller') {
                $this->route->$key = $value;
            }
            if($key === 'view') {
                $this->route->$key = $value;
            }
            if($key === 'modificator') {
                $this->route->$key = $value;
            }
            if(property_exists($this, $key)) {
                $this->$key = $value;
            }
        }
    }

    protected function run() {
        $cache = Cache::instance();
        $this->menuHtml = $cache->get($this->cacheKey);
        if(!$this->menuHtml) {
            $this->data = App::$app->getProperty('cats');
            if(!$this->data) {
                $this->data = $cats = R::getAssoc("SELECT * FROM {$this->table}");
            }
        }
        $this->tree = $this->getTree();
        $this->menuHtml = $this->getMenuHtml($this->tree);
        $this->output();
    }

    protected function output() {
        echo $this->menuHtml;
    }

    protected function getTree() {
        $tree = [];
        $data = $this->data;
        foreach($data as $id => &$node) {
            if(!$node['id_parent']) {
                $tree[$id] = &$node;
            } else {
                $data[$node['id_parent']]['childs'][$id] = &$node;
            }
        }
        return $data;
    }


    protected function getMenuHtml($tree) {
        $str = '';
        foreach($tree as $id => $category) {
            $str .= $this->catToTemplate($category, $id);
        }
        return $str;
    }

    protected function catToTemplate($category, $id) {
        ob_start();
        require $this->tpl;
        return ob_get_clean();
    }

    public function isActive($id) {
        $isRoute = new \stdClass();
        $href = $this->tree[$id]['href'];
        $regexp = '/^(?P<controller>[a-z-]+)\/?(?P<view>[a-z-]+)?\/?(?P<modificator>[a-z-]+)?$/iu';


        $isRoute->controller = null;
        $isRoute->view = null;
        $isRoute->modificator = null;

        if($href === './') {
            $isRoute->controller = 'Main';
            $isRoute->view = 'index';
            $isRoute->modificator = null;
        } elseif($href) {
            preg_match($regexp, $href, $matches);
            foreach($matches as $key => $value) {
                if(is_int($key)) {
                    unset($matches[$key]);
                } else {
                    if($key === 'controller') {
                        $isRoute->$key = ucfirst($value);
                    } else {
                        $isRoute->$key = $value;
                    }
                }
            }
        }
        if($isRoute->modificator) {
            if($this->route->controller === $isRoute->controller &&
                $this->route->view === $isRoute->view &&
                $this->route->modificator === $isRoute->modificator) {
                return true;
            }
        } elseif($this->route->controller === $isRoute->controller && $this->route->view === $isRoute->view) {
            return true;
        }
        return false;
    }
}
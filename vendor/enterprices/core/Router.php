<?php


namespace enterprices;


class Router {
    protected static $routes = [];
    protected static $route = [];

    public static function add($regexp, $route = []) {
        self::$routes[$regexp] = $route;
    }

    public static function getRoutes() {
        return self::$routes;
    }

    public static function getRoute() {
        return self::$route;
    }

    public static function dispatch($url) {
        $url = self::removeQueryString($url);

        if(self::matchRoute($url)) {
            $controller = 'app\controllers\\' . self::$route['controller'] . 'Controller';
            if(class_exists($controller)) {
                $controllerObject = new $controller(self::$route);
                $action = self::lowerCamelCase(self::$route['action']) . 'Action';
                if(method_exists($controllerObject, $action)) {
                    $controllerObject->$action();
                    $controllerObject->getView();
                } else {
                    throw new \Exception("Method $controller::$action not found", 404);
                }
            } else {
                throw new \Exception("Controller $controller not found", 404);
            }
        } else {
            throw new \Exception('Page not found', 404);
            die;
        }
    }

    public static function matchRoute($url) {
        foreach(self::$routes as $regexp => $route) {
            if(preg_match($regexp, $url, $matches)) {
                foreach($matches as $key => $value) {
                    if(is_string($key)) {
                        $route[$key] = $value;
                    }
                }
                if(empty($route['action'])) {
                    $route['action'] = 'index';
                }
                $route['controller'] = self::upperCamelCase($route['controller']);
                self::$route = $route;
                return true;
            }
        }
        return false;
    }

    // Result: UpperCamelCase
    protected static function upperCamelCase($string) {
        $string = str_replace('-', ' ', $string);
        $string = ucwords($string);
        $string = str_replace(' ', '', $string);
        return $string;
    }

    // Result: lowerCamelCase
    protected static function lowerCamelCase($string) {
        $string = self::upperCamelCase($string);
        $string = lcfirst($string);
        return $string;
    }

    protected static function removeQueryString($url) {
        if($url) {
            $params = explode('&', $url, 2);
            if(strpos($params[0], '=') === false) {
                return rtrim($params[0], '/');
            } else {
                return '';
            }
        }
    }
}
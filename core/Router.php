<?php


namespace core;



class Router
{
    protected static $routes = []; //  all routes
    protected static $route = []; // current route

    /**
     * Формує роути
     * @param $regexp 'posts/add'
     * @param array $route ['controller'=>'Posts', ]
     */
    public static function add($regexp, $route=[])
    {
        self::$routes[$regexp] = $route;
    }


    public static function getRoutes()
    {
        return self::$routes;
    }


    public static function getRoute()
    {
        return self::$route;
    }

    private static function matchRoute($url)
    {
        foreach(self::$routes as $pattern => $route){
            if(preg_match("~$pattern~i", $url, $matches)){
                //debug($matches);
                foreach ($matches as $k => $v){
                    if(is_string($k)){
                        $route[$k] = $v;
                    }
                }
                if(!isset($route['action'])){
                    $route['action'] = 'index';
                }
                $route['controller'] = self::upperCamelCase($route['controller']);
                self::$route = $route;
                //debug($route);

                return true;
            }
        }
        return false;
    }

    public static function dispatch($url)
    {
        $url = self::removeQueryString($url);

        if(self::matchRoute($url)){
            $controller = 'app\controllers\\' . self::$route['controller'].'Controller';
            if(class_exists($controller)){
                //debug(self::$route);
                $cObj = new $controller(self::$route);

                $action = self::lowerCamelCase(self::$route['action']).'Action';
                //debug($action);
                if(method_exists($cObj, $action)){
                    if(isset(self::$route['alias'])){ // якщо є параметр
                        $cObj->$action(self::$route['alias']); // передаємо його у метод
                    } else {
                        $cObj->$action();
                    }
                    //debug(self::$route);

                    $cObj->getView(); // вивід View
                } else {
                    echo "Action $action not found";
                }
            } else {
                echo "Controller $controller not found.";
            }
            //debug($controller);
            //debug($action);
        } else {
            http_response_code(404);
            //include 404.php
        }
    }
    protected static function upperCamelCase($name)
    {
        $name = str_replace('-', ' ', $name);
        $name = ucwords($name);
        $name = str_replace(' ', '', $name);
        return $name;
    }

    protected static function lowerCamelCase($name)
    {
        $name = self::upperCamelCase($name);
        $name = lcfirst($name);
        return $name;
    }

    protected static function removeQueryString($url)
    {
        if ($url) {
            $params = explode('&', $url);
            //debug($params);
            if(false === strpos($params[0], '=')){
                return rtrim($params[0], '/');
            }else{
                return '';
            }
        }

        return $url;
    }


}
<?php

namespace App\Core;

class Router{

    protected static $routes = [];

    static function get($url, $action){
        self::$routes['GET'][$url] = $action;
    }

    static function post($url, $action){

    }

    public static function dispatch($url, $method){
        $url = explode('/', parse_url($url, PHP_URL_PATH));
        $url = end($url);
        // print_r($url);
        $url = '/'. $url;

        $method_routes = self::$routes[$method] ?? [];  

        // echo "<pre>";
        // print_r($method_routes);
        // echo "</pre>";

        if(!array_key_exists($url, $method_routes)){
            http_response_code(404);
            echo 'page not found.';
            return;
        }

        $action = $method_routes[$url];

        if(is_callable($action)){
            call_user_func($action);

        } elseif(is_array($action)){
            $controllerClass = $action[0];
            if (strpos($controllerClass, '\\') === false) {
                $controllerClass = "App\\Controllers\\$controllerClass";
            }
            $controllerFile = __DIR__ . "/../Controllers/" . basename(str_replace('\\', '/', $controllerClass)) . ".php";
            if (!file_exists($controllerFile)) {
                http_response_code(500);
                echo "Controller file not found.";
                return;
            }
            require_once $controllerFile;
            $controllerInstance = new $controllerClass();
            call_user_func_array([$controllerInstance, $action[1]], []);
            
        } elseif (is_string($action)) {
            // Get the controller name and method
            [$controller, $method] = explode('@', $action);

            // get controller class name with namespace
            $controllerClass = "App\\Controllers\\$controller";

            // get controller file path
            $controllerFile = __DIR__ . "/../Controllers/$controller.php";

            // check if file exists
            if (!file_exists($controllerFile)) {
                http_response_code(500);
                echo "Controller file not found.";
                return;
            }

            require_once $controllerFile;

            // create a controller instance
            $controllerInstance = new $controllerClass;

            if (!method_exists($controllerInstance, $method)) {
                http_response_code(500);
                echo "Method $method not found in controller $controllerClass.";
                return;
            }

            $controllerInstance->$method();
        } else {
            http_response_code(500);
            echo "Invalid route action.";
        }
    }



}
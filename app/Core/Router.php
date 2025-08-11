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

        // print_r($url);

        $route = self::$routes[$method] ?? [];  

        
        if(!array_key_exists($url, $route)){
            http_response_code(404);
            echo 'page not found.';
            return;
        }

        

    }



}
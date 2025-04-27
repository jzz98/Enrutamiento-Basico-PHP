<?php
namespace routers;

class Router
{
    private static $routes = [
        'GET' => [],
        'POST' => [],
    ];


    public static function get($uri, $callback){
        self::$routes['GET'][self::normalizeUri($uri)] = $callback;
    }

    public static function post($uri, $callback){
        self::$routes['POST'][self::normalizeUri($uri)] = $callback;
    }

    private static function normalizeUri($uri){
        return trim($uri, '/');
    }

    public static function Run(){
        $method = $_SERVER['REQUEST_METHOD'];
        $request_uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $normalized_uri = self::normalizeUri($request_uri);

        if(isset(self::$routes[$method][$normalized_uri])){
            $callback = self::$routes[$method][$normalized_uri];

            if(is_callable($callback)){
                return $callback();
            }else{
                http_response_code(500);
                echo "Error 404";
            }
        }else{
            http_response_code(404);
            echo "ruta no encontrada";
        }
    }
}
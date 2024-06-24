<?php
namespace App\Http\Middleware;

use mysql_xdevapi\Exception;

class Queue{

    private static $default = [];
    private static $map = [];

    private $middlewares = [];
    private $controller;
    private $controllersArgs = [];


    public function __construct($middlewares,$controller,$controllersArgs){

        $this->middlewares = array_merge(self::$default, $middlewares);
        $this->controller = $controller;
        $this->controllersArgs = $controllersArgs;
    }

    public static function setMap($map){
        self::$map = $map;
    }

    public static function setDeafault($default){

        self::$default = $default;
    }


    public function next($request){

        if(empty($this->middlewares)) return call_user_func_array($this->controller, $this->controllersArgs);

        $middleware = array_shift($this->middlewares);

        if(!isset(self::$map[$middleware])){
            throw new \Exception("Problemas ao carregar middleware", 500);
        }

        $queue = $this;

        $next = function($request) use($queue){
            return $queue->next($request);
        };

       return (new  self::$map[$middleware])->handle($request,$next);
    }
}
<?php
class Router
{
    protected static $routes = [];
    protected static $routesPost = [];
    protected static $instance;
    protected static $params = [];


    private function __construct()
    {
        return $this;
    }

    public static function getInstance()
    {
        if(Router::$instance === null)
        {
            Router::$instance = new Router();
        }
        else return Router::$instance;
    }

    public static function get($uri, $controller)
    {
        $controller = explode("@", $controller);
        self::$routes[] = [
            'uri'  =>  explode('/', $uri),
            'controller'   =>  $controller[0],
            'method'    =>  $controller[1]
        ];
    }
    public static function post($uri, $controller)
    {
        $uri = explode("|", $uri);
        $controller = explode("@", $controller);
        self::$routesPost[] = [
            'uri'  =>  explode('/', $uri[0]),
            'controller'   =>  $controller[0],
            'method'    =>  $controller[1],
            'postMethod' => $uri[1]
        ];
    }
    private static function match($route, $reqRoute)
    {
        $args = [];
        if(count($route) != count($reqRoute)) return false;
        foreach($route as $ind => $path)
        {
            //var_dump($reqRoute);
            if($path[0] == '{')
            {
                $args[] = $reqRoute[$ind];
                continue;
            }
            if($path != $reqRoute[$ind]) return false;
        }
        return $args;
    }

    private static function go($controllerName, $methodName, $args = [])
    {
        include_once("App/Controllers/$controllerName.php");
        $thisController = new $controllerName();
        if(count($args))call_user_func_array([$thisController, $methodName], $args);
        call_user_func([$thisController, $methodName]);
    }
    private static function goPost($controllerName, $methodName, $postMethod, $args = null)
    {
        include_once("App/Controllers/$controllerName.php");
        $thisController = new $controllerName();
        call_user_func_array([$thisController, $methodName], $args);
        call_user_func([$thisController, $postMethod]);
    }

    public static function run()
    {
        $requiredRoute = explode('/', $_GET['route']);
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            foreach(Router::$routes as $route)
            {
                if($args = Router::match($route['uri'], $requiredRoute))
                {
                    //var_dump($args);
                    Router::go($route['controller'], $route['method'], $args);
                    return true;
                }
            }
        }
        else if($_SERVER['REQUEST_METHOD'] === 'POST')
        {
            foreach(Router::$routesPost as $route)
            {
                if($args = Router::match($route['uri'], $requiredRoute))
                {
                    //var_dump($args);
                    Router::goPost($route['controller'], $route['method'],$route['postMethod'], $args);
                    return true;
                }
            }
        }
        echo("404");
        return false;
    }

    public function getRoutes()
    {
        return $this->routes;
    }

}
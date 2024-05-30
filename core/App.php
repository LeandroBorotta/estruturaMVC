<?php

namespace Core;

class App
{
    protected $controller;

    protected $url;

    protected $method;
    protected $params = [];
    protected $router;

    public function __construct(Router $router)
    {
        $this->router = $router;
        $this->parseUrl();
    }

    public function run()
    {

        $routeInfo = $this->router->match($this->url);

        if ($routeInfo) {
            $controllerClass = 'App\\Controllers\\' . $routeInfo['controller'];

            $this->method = $routeInfo['method'];

            if (class_exists($controllerClass)) {
                $this->controller = new $controllerClass;
            } else {
                die("Controller não encontrado: " . $controllerClass);
            }

            if (method_exists($this->controller, $this->method)) {

                call_user_func_array([$this->controller, $this->method], $this->params);
            } else {
                die("Método não encontrado: " . $this->method);
            }
        } else {
            return route('errors/notFound');
        }
    }

    private function parseUrl()
    {

        $url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $url = strstr($url, "/public/");
        $url = substr($url, strlen("/public/"));
        
      
        $route = $this->router->getRoute($url);
        $this->url = ($url !== "public") ? $url : "";
        $this->controller = $route['controller'] ?? "";
        $this->method = $route['method'];
        
        $params = explode('/', $url);

        $this->params = $params; 
    
        
    }
}

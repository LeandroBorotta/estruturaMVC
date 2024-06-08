<?php

namespace Core;

class Router
{
    private $routes = [];

    public function add($route, $controller, $method = 'index', $requiresAuth = false)
    {
        $this->routes[$route] = ['controller' => $controller, 'method' => $method, 'requiresAuth'=> $requiresAuth];
    }

    public function getRoute($route)
    {
        if (isset($this->routes[$route])) {
            return $this->routes[$route];
        }

        foreach ($this->routes as $pattern => $info) {
            $urlParts = explode('/', $route);
            $routeParts = explode('/', $route);

            if (count($urlParts) !== count($routeParts)) {
                continue;
            }

            $params = [];

            $matched = true;
            foreach ($routeParts as $key => $part) {

                if (strpos($part, '{') === 0 && strpos($part, '}') === (strlen($part) - 1)) {

                    $paramName = substr($part, 1, -1);
                    $params[$paramName] = $urlParts[$key];
                } elseif ($part !== $urlParts[$key]) {
                    $matched = false;
                    break;
                }
            }

            $info['params'] = $params;
            return $info;
        }

        return null;
    }


    public function match($url): array|null
    {
        foreach ($this->routes as $route => $info) {
            if ($route === $url) {
                return $info;
            }

            $urlParts = explode('/', $url);
            $routeParts = explode('/', $route);

            if (count($urlParts) !== count($routeParts)) {
                continue;
            }

            $params = [];
            $matched = true;

            foreach ($routeParts as $key => $part) {
                if (strpos($part, '{') === 0 && strpos($part, '}') === (strlen($part) - 1)) {
                    $paramName = substr($part, 1, -1);
                    $params[$paramName] = $urlParts[$key];
                } elseif ($part !== $urlParts[$key]) {
                    $matched = false;
                    break;
                }
            }

            if ($matched) {
                $info['params'] = $params;
                return $info;
            }
        }

        return null;
    }
}

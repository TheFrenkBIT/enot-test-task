<?php

namespace App\Router;

use App\Auth\AuthInterface;
use App\Controllers\Controller;
use App\CurrencyRates\RatesInterface;
use App\Database\DatabaseInterface;

class Router
{
    private array $routes = [
        'POST' => [],
        'GET' => []
    ];
    public function __construct(
        private DatabaseInterface $database,
        private AuthInterface $auth,
        private RatesInterface $rates
    )
    {
        $this->initRoutes();
    }

    public function dispatch(string $uri, string $method) : void
    {
        $route = $this->findRoute($uri, $method);
        if (!$route)
        {
            $this->notFound();
        }
        if (is_array($route->getAction()))
        {
            [$controller, $action] = $route->getAction();
            $controller = new $controller();
            call_user_func([$controller, 'setDatabase'], $this->database);
            call_user_func([$controller, 'setAuth'], $this->auth);
            call_user_func([$controller, 'setRates'], $this->rates);
            call_user_func([$controller, $action]);
        } else {
            call_user_func($route->getAction());
        }
    }
    private function notFound() : void
    {
        echo '404 Not Found';
        exit;
    }

    /**
     * @param string $uri
     * @param string $method
     * @return Route|false
     */
    private function findRoute(string $uri, string $method) : Route|false
    {
        if(!isset($this->routes[$method][$uri]))
        {
            return false;
        }
        return $this->routes[$method][$uri];
    }
    public function initRoutes(): void
    {
        $routes = $this->getRoutes();
        foreach ($routes as $route)
        {
            $this->routes[$route->getMethod()][$route->getUri()] = $route;
        }
    }

    /**
     * @return Route[]
     */
    private function getRoutes() : array
    {
        return require_once APP_PATH . '/config/routes.php';
    }
}
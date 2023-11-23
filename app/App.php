<?php

namespace App;
use App\Container\Container;
use App\Router\Router;
class App
{
    private Container $container;
    public function __construct()
    {
        $this->container = new Container();
    }
    public function run() : void
    {
      $this->container->route->dispatch($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);
    }
}
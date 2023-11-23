<?php

namespace App\Container;

use App\Auth\Auth;
use App\Auth\AuthInterface;
use App\CurrencyRates\Rates;
use App\CurrencyRates\RatesInterface;
use App\Database\Database;
use App\Database\DatabaseInterface;
use App\Router\Router;
use Symfony\Component\VarDumper\Cloner\Data;

class Container
{
    public function __construct()
    {
        $this->registerServices();
    }

    public readonly Router $route;
    public readonly DatabaseInterface $database;
    public readonly AuthInterface $auth;
    public readonly RatesInterface $rates;

    private function registerServices()
    {
        $this->database = new Database();
        $this->auth = new Auth($this->database);
        $this->rates = new Rates();
        $this->route = new Router($this->database, $this->auth, $this->rates);
    }
}
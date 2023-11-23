<?php

namespace App\Controllers;
use App\Auth\AuthInterface;
use App\CurrencyRates\Rates;
use App\CurrencyRates\RatesInterface;
use App\Database\DatabaseInterface;

abstract class Controller
{
    private DatabaseInterface $database;
    private AuthInterface $auth;
    private RatesInterface $rates;
    public function setDatabase(DatabaseInterface $database): void
    {
        $this->database = $database;
    }
    public function db(): DatabaseInterface
    {
        return $this->database;
    }
    public function setAuth(AuthInterface $auth): void
    {
        $this->auth = $auth;
    }
    public function auth(): AuthInterface
    {
        return $this->auth;
    }
    public function setRates(RatesInterface $rates): void
    {
        $this->rates = $rates;
    }
    public function rates(): RatesInterface
    {
        return $this->rates;
    }
}
<?php

namespace App\CurrencyRates;

interface RatesInterface
{
    public function request(array $data) : string;
    public function xmlParse(string $xml) : array;
    public function getRatesForSave() : array;
}
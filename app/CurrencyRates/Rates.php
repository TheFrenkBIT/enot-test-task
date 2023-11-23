<?php

namespace App\CurrencyRates;

class Rates implements RatesInterface
{
    private string $requestUri = 'http://www.cbr.ru/scripts/XML_daily.asp';


    public function request($data): string
    {
        $queryData = http_build_query($data);
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_HEADER => 0,
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => $this->requestUri.'?'.$queryData,
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
    }
    public function xmlParse(string $xml): array
    {
        $rates = [];
        $xmlData = simplexml_load_string($xml);
        foreach ($xmlData as $rateObj)
        {
            $rate = str_replace(',', '.',((array)($rateObj->VunitRate))[0]);
            $rates[((array)($rateObj->Name))[0]] = [
                'self_to_rub' => $rate,
                'rub_to_self' => $this->convertToRub($rate),
                'id' => ((array)($rateObj->attributes()->ID))[0]
            ];
        }
        return $rates;
        // TODO: Implement xmlParse() method.
    }
    private function convertToRub(float $value) : float
    {

        return $value != 0 ? (1/$value) :  0;
    }
    public function getRatesForSave(): array
    {
        $xml = $this->request([
            'date_req' => date('d/m/Y')
        ]);
        return $this->xmlParse($xml);
    }
}
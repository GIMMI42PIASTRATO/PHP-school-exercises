<?php

declare(strict_types=1);

class ExchangeRates
{
    private array $exchangeRateTable = [
        "EUR - Euro" => 1,
        "USD - Dollaro Statunitense" => 1.0818,
        "JPY - Yen Giapponese" => 165.18,
        "CHF - Franco Svizzero" => 1.0504,
    ];

    function getExchangeRateTable()
    {
        return $this->exchangeRateTable;
    }

    function setExchangeRateTable(array $exchangeRateTable)
    {
        $this->exchangeRateTable = $exchangeRateTable;
    }

    function getExchangeRate(string $currency): ?float
    {
        if (!isset($this->exchangeRateTable[$currency])) {
            return null;
        }

        return $this->exchangeRateTable[$currency];
    }

    function setExchangeRate(string $currency, float $rate)
    {
        $this->exchangeRateTable[$currency] = $rate;
    }
}

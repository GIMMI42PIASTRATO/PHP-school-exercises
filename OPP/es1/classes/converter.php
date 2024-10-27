<?php

declare(strict_types=1);
require_once './classes/exchangeRate.php';

class Converter
{
    private int $value1 = 0;
    public ExchangeRates $exchangeRateTable;

    function __construct(int $value1 = 0)
    {
        $this->value1 = $value1;
        $this->exchangeRateTable = new ExchangeRates();
    }

    function setValue1(int $value1)
    {
        $this->value1 = $value1;
    }

    function getValue1()
    {
        return $this->value1;
    }

    function convert(string $fromCurrency, string $toCurrency): float | null
    {
        if ($this->exchangeRateTable->getExchangeRate($fromCurrency) === null || $this->exchangeRateTable->getExchangeRate($toCurrency) === null) {
            return null;
        }

        $rate = $this->exchangeRateTable->getExchangeRate($toCurrency) / $this->exchangeRateTable->getExchangeRate($fromCurrency);
        return $this->value1 * $rate;
    }
}

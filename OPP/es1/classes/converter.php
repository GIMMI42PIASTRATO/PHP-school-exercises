<?php

declare(strict_types=1);

class Converter
{
    private int $value1 = 0;
    private array $exchangeRateTable = [
        "USD" => 1.0853,
        "YEN" => 162.79,
    ];

    function __construct(int $value1 = 0)
    {
        $this->value1 = $value1;
    }

    function setValue1(int $value1)
    {
        $this->value1 = $value1;
    }

    function setExchangeRateTableA(array $exchangeRateTable)
    {
        $this->exchangeRateTable = $exchangeRateTable;
    }

    function getExchangeRateTable()
    {
        return $this->exchangeRateTable;
    }

    function getValue1()
    {
        return $this->value1;
    }

    function convert(string $currency): float | null
    {
        if (!isset($this->exchangeRateTable[$currency])) {
            return null;
        }

        return $this->value1 * $this->exchangeRateTable[$currency];
    }
}

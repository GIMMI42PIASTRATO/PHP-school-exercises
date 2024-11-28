<?php
declare(strict_types=1);

class ALU {
    public static function add(float $a, float $b): float
    {
        return $a + $b;
    }

    public static function subtract(float $a, float $b): float
    {
        return $a - $b;
    }

    public static function multiply(float $a, float $b): float
    {
        return $a * $b;
    }

    public static function divide(float $a, float $b): float
    {
        return $a / $b;
    }

    public static function power(float $a, float $b): float
    {
        return $a ** $b;
    }

    public static function root(float $a, float $b): float
    {
        return $a ** (1 / $b);
    }

    public static function factorial(int $a): int
    {
        $result = 1;
        for ($i = 1; $i <= $a; $i++) {
            $result *= $i;
        }
        return $result;
    }

    public static function reciprocal(float $a): float
    {
        return 1 / $a;
    }

    public static function absolute(float $a): float
    {
        return abs($a);
    }

    public static function sin(float $a): float
    {
        return sin($a);
    }

    public static function cos(float $a): float
    {
        return cos($a);
    }

    public static function tan(float $a): float
    {
        return tan($a);
    }

    public static function sec(float $a): float
    {
        return 1 / cos($a);
    }

    public static function csc(float $a): float
    {
        return 1 / sin($a);
    }

    public static function cot(float $a): float
    {
        return 1 / tan($a);
    }
}
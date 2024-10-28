<?php

declare(strict_types=1);


class RandomImageSelector
{
    static function selectRandomImage(int $min, int $max): string
    {
        $randomnumber = random_int($min, $max);
        return "img$randomnumber.jpg";
    }
}

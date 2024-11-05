<?php

declare(strict_types=1);

function FunzioneCavallo(int $altezza, int $età): int | string
{
    $ARR_altezza = array();
    $numeriPari = 0;

    // controlla se l'altezza è uguale a zero
    if ($altezza === 0) {
        return "NON POSSO DIVIDERE PER ZERO";
    }

    // inserisce 5 elementi nell'arra
    for ($i = 0; $i < 5; $i++) {
        $elementoArr = 5 / $altezza + random_int(1, 10);

        array_push($ARR_altezza, $elementoArr);
    }

    echo var_dump($ARR_altezza);

    foreach ($ARR_altezza as $number) {
        // controlla se il numero è pari
        if ($number % 2 === 0) {
            $numeriPari++;
        }
    }

    if ($numeriPari === 0) {
        return "NON PRESENTI";
    } else {
        return $numeriPari;
    }
}

echo FunzioneCavallo(5, 50);

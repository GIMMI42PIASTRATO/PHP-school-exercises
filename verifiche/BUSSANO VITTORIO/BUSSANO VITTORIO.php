<?php

declare(strict_types=1);

class Cavallo
{
    private int $altezza;
    private int $eta;

    public function __construct(int $altezza, int $eta)
    {
        $this->altezza = $altezza;
        $this->eta = $eta;
    }

    // getter e setter per l'attributo altezza
    public function setAltezza(int $altezza)
    {
        $this->altezza = $altezza;
    }

    public function getAltezza(): int
    {
        return $this->altezza;
    }

    // metodo che restituisce $this->altezza * $this->eta
    public function altezzaPerEta()
    {
        return $this->altezza * $this->eta;
    }
}

class Cavallo_der extends Cavallo
{
    protected float $peso;

    public function __construct(int $altezza, int $eta, float $peso)
    {
        parent::__construct($altezza, $eta);
        $this->peso = $peso;
    }

    public static function stringaDer(): string
    {
        return "Cavallo_der";
    }

    public function altezzaPerEta()
    {
        // controllo se il peso e uguale a zero, se si restituisco una stringa di errore
        if ($this->peso === 0.0) {
            return "Impossibile dividere per zero";
        }

        // se il peso è diverso da zero allora restituisco il risultato
        return parent::altezzaPerEta() / $this->peso;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test classi</title>
</head>

<body>

    <!-- Test metodi classe Cavallo -->
    <h1>Test metodi classe Cavallo</h1>
    <?php
    // Istanzio cavallo
    $cavallo1 = new Cavallo(10, 5);
    // Setto l'altezza a 5
    $cavallo1->setAltezza(-12);
    ?>
    <div>Altezza cavallo: <?= $cavallo1->getAltezza(); ?></div>
    <div>Cavallo altezza per eta: <?= $cavallo1->altezzaPerEta(); ?></div>

    <br>
    <br>

    <!-- Test metodi classe Cavallo_der -->
    <h1>Test metodi classe Cavallo_der</h1>
    <?php
    $cavallo_der = new Cavallo_der(5, 5, 0);
    $cavallo_der->setAltezza(-7);
    ?>

    <div>Altezza Cavallo_der: <?= $cavallo_der->getAltezza(); ?></div>
    <div>StringaDer: <?= Cavallo_der::stringaDer(); ?></div>
    <div>Cavallo_der altezza per eta (ovverrided): <?= $cavallo_der->altezzaPerEta(); ?> </div>
</body>

</html>
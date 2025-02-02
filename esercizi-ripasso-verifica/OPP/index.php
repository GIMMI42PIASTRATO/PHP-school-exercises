<?php

declare(strict_types=1);

//* ereditarietà e overriding the metodi, utilizzando anche la keyword parent per chiamare il metodo overrided in modo da riutilizzare la sua logica senza doverla scrivere nuovamente così rispettando il principio DRY

class Fruit
{
    private string $name;
    private string $color;

    public function __construct($name, $color)
    {
        $this->name = $name;
        $this->color = $color;
    }

    public function intro()
    {
        echo "The fruit is a $this->name and the color is $this->color";
        return "🗿🗿🗿";
    }
}

class Strawberry extends Fruit
{
    private int $weight;

    public function __construct($name, $color, $weight)
    {
        parent::__construct($name, $color);
        $this->weight = $weight;
    }

    public function intro()
    {
        $test = parent::intro();
        echo " and the weight is $this->weight gram\n";
        echo "🗿 Yeah the test is $test";
    }
}

$obj1 = new Strawberry(weight: 50, color: "Red", name: "Strawberry");
$obj1->intro();


//* La final keyword permete di prevenire l'ereditarietà di una classe oppure previene l'ovverriding dei metodi

final class Person
{
    public function __construct()
    {
        // Some code
    }
}

// class Students extends Person   //! Fatal error: Class Students cannot extend final class Person in C:\xampp\htdocs\vittoriobussano\esercizi-ripasso-verifica\OPP\index.php on line 55
// {
//     public function __construct()
//     {
//         // Some other code
//     }
// }


//* Proprietà statiche e metodi statici
//* Le proprietà statiche appartenendo alla classe è non alla istanza possono essere accesse da entrambe, quindi effetivamente una proprietà statica è la stessa cosa di una proprietà di classe.

//? All'interno della classe è possibile accedere ai metodi statici utilizzando la keyword self seguita da :: e il nome del metodo oppure $nomeDellaProprietà

class Esempio
{
    private static $counter = 0;

    public static function increaseCounter()
    {
        Esempio::$counter++;
    }

    public static function getCounter()
    {
        return self::$counter;
    }
}

class Esempio2 extends Esempio
{
    public static function getCounter()
    {
        return parent::getCounter();
    }
}

Esempio::increaseCounter();

$obj1 = new Esempio();
$obj2 = new Esempio();
echo "obj1: " . $obj1->getCounter() . "\n";
echo "obj2: " . $obj2->getCounter() . "\n";

$obj3 = new Esempio2();
echo "obj3: " . $obj3->getCounter() . "\n";



//* Costanti di classe
//* Alle costanti di classe ci si può accedere dall'interno della classe utilizzando la keyword self seguita dai :: e il nome della costante
//* Alle costanti di classe ci si può accedere dall'esterno della classe utilizzando il nome della classe seguito da :: e il nome della costante

class Goodby
{
    const GOODBY_MESSAGE = "Adios doner kebab nacho alejandro garnacho";

    public static function byebye()
    {
        echo "Vittorio dice " . self::GOODBY_MESSAGE . "\n";
    }
}

echo Goodby::GOODBY_MESSAGE;
echo Goodby::byebye();



//* Una classe astratta contiene metodi che hanno un nome ma il loro contenuto deve essere riempito dalle classi figlie
//* Una classe astratta è una classe che contiene almeno un metodo astratto
//* Un metodo astratto è un metodo che è dichiarato ma non è implementato
//* Una classe astratta o un metodo astratto sono definiti utilizzando la keyword abstract

abstract class ParentClass
{
    abstract public function someMethod1();
    abstract public function someMethod2($name, $color);
    abstract public function someMethod3(): string;
}

class ChildClass extends ParentClass
{
    public function someMethod1()
    {
        echo "I have implemented this method";
    }

    public function someMethod2($name, $color)
    {
        echo "Your name is $name and your favorite color is $color";
    }

    public function someMethod3(): string
    {
        $random_number = (string) random_int(1, 2);

        return "My random number is $random_number";
    }
}

echo (new ChildClass())->someMethod3();

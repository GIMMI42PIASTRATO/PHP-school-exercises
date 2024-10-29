<?php

declare(strict_types=1);

class Vehicle
{
    public function accelerates()
    {
        echo "Accelerating Vehicle";
    }
}


final class Autovehicle extends Vehicle
{
    public function accelerates()
    {
        echo "Accelerating Autovehicle";
    }
}

final class Motocycle extends Vehicle
{
    public function accelerates()
    {
        echo "Accelerating Motocycle";
    }
}

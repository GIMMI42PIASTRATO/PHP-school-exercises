<?php

declare(strict_types=1);

class Vehicle
{
    protected string $brand;
    protected DateTime $year;

    public function __construct(string $brand, DateTime $year)
    {
        $this->brand = $brand;
        $this->year = $year;
    }

    public function getInfo()
    {
        return "Brand: $this->brand, Year: " . $this->year->format('Y');
    }

    public static function category()
    {
        return "General";
    }
}

class Car extends Vehicle
{
    private string $model;

    public function __construct(string $brand, DateTime $year, string $model)
    {
        parent::__construct($brand, $year);
        $this->model = $model;
    }

    public function getInfo()
    {
        return parent::getInfo() . ", Model: $this->model";
    }

    public static function category()
    {
        return "Car";
    }
}

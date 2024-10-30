<?php

declare(strict_types=1);

class GeometricFigure
{
    const DESCRIPTION = "A non-empty, continuous set of points such as to create an undeformable, inextensible form, and may have 3 dimensions (three-dimensional), 2 dimensions (two-dimensional), 1 dimension (one-dimensional) or 0 dimensions (dimensionless).";
    const NUMBER_OF_SIDES = 0;

    public function description(): string
    {
        return self::DESCRIPTION;
    }

    public function calculateArea(): float
    {
        return 0;
    }
}


class Square extends GeometricFigure
{
    const DESCRIPTION = "A rectangle having all four sides of equal length.";
    const NUMBER_OF_SIDES = 4;

    private float $sidesLenght = 0;

    public function __construct(float $sideLenght)
    {
        $this->sidesLenght = $sideLenght;
    }

    public function setSideLenght(float $sideLenght)
    {
        $this->sidesLenght = $sideLenght;
    }

    public function getSideLenght(): float
    {
        return $this->sidesLenght;
    }

    public function calculateArea(): float
    {
        return $this->sidesLenght ** 2;
    }
}


class Triangle extends GeometricFigure
{
    const DESCRIPTION = "A polygon with three corners and three sides";
    const NUMBER_OF_SIDES = 3;

    private float $sideLenght1 = 0;
    private float $sideLenght2 = 0;
    private float $sideLenght3 = 0;

    public function __construct(float $sideLenght1, float $sideLenght2, float $sideLenght3)
    {
        $this->sideLenght1 = $sideLenght1;
        $this->sideLenght2 = $sideLenght2;
        $this->sideLenght3 = $sideLenght3;
    }

    public function setSideLenght1(float $sideLenght1)
    {
        $this->sideLenght1 = $sideLenght1;
    }

    public function getSideLenght1(): float
    {
        return $this->sideLenght1;
    }

    public function setSideLenght2(float $sideLenght2)
    {
        $this->sideLenght2 = $sideLenght2;
    }

    public function getSideLenght2(): float
    {
        return $this->sideLenght2;
    }

    public function setSideLenght3(float $sideLenght3)
    {
        $this->sideLenght3 = $sideLenght3;
    }

    public function getSideLenght3(): float
    {
        return $this->sideLenght3;
    }

    public function calculateArea(): float
    {
        // Heron's formula for calculating the area of a triangle given the lengths of its sides
        $semiPerimeter = ($this->sideLenght1 + $this->sideLenght2 + $this->sideLenght3) / 2;
        return sqrt($semiPerimeter * ($semiPerimeter - $this->sideLenght1) * ($semiPerimeter - $this->sideLenght2) * ($semiPerimeter - $this->sideLenght3));
    }
}

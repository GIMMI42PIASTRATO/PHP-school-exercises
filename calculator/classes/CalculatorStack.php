<?php

declare(strict_types=1);

class CalculatorStack
{
    private static $instance;
    private array $stack = [];

    // private constructor to prevent creating new instances
    private function __construct() {}

    // method used to create a single instance of the class (singleton)
    public static function create(): CalculatorStack
    {
        if (!isset(self::$instance)) {
            $instance = new CalculatorStack();
        }

        return $instance;
    }

    public function push($value): void
    {
        array_push($this->stack, $value);
    }

    public function pop()
    {
        return array_pop($this->stack);
    }

    public function peek()
    {
        return $this->stack[count($this->stack) - 1];
    }

    public function get(): array
    {
        return $this->stack;
    }

    public function set(array $stack): void
    {
        $this->stack = $stack;
    }
}

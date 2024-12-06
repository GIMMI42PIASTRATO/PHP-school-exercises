<?php

declare(strict_types=1);

class Keyboard
{
    private array $keys = [];

    public function __construct()
    {
        $this->keys = [
            new Key('sin', 'key operator'),
            new Key('cos', 'key operator'),
            new Key('tan', 'key operator'),
            new Key('C', 'key operator'),
            new Key('⌫', 'key operator'),
            new key('sec', 'key operator'),
            new Key('csc', 'key operator'),
            new Key('cot', 'key operator'),
            new Key('x^2', 'key operator'),
            new Key('x^n', 'key operator'),
            new Key('√', 'key operator'),
            new Key('n√', 'key operator'),
            new Key('n!', 'key operator'),
            new Key('1/n', 'key operator'),
            new key('/', 'key operator'),
            new Key('MEM', 'key operator', "submit", "memory"),
            new Key('STO', 'key operator', "submit", "memory"),
            new Key('M+', 'key operator', "submit", "memory"),
            new Key('ABS', 'key operator'),
            new key('*', 'key operator'),
            new key('9', 'key number'),
            new key('8', 'key number'),
            new key('7', 'key number'),
            new key('6', 'key number'),
            new key('-', 'key operator'),
            new key('5', 'key number'),
            new key('4', 'key number'),
            new key('3', 'key number'),
            new key('2', 'key number'),
            new key('+', 'key operator'),
            new key('1', 'key number'),
            new key('0', 'key number'),
            new Key('PI', 'key number'),
            new key('.', 'key number'),
            new key('=', 'key equal', "submit", "calculate"),
        ];
    }

    public function keysLenght(): int
    {
        return count($this->keys);
    }

    public function __toString(): string
    {
        $keyboard = '';
        foreach ($this->keys as $key) {
            $keyboard .= $key;
        }
        return $keyboard;
    }
}

<?php
declare(strict_types=1);

class Keyboard
{
    private array $keys = [];

    public function __construct()
    {
        $this->keys = [
            new Key('sin', 'function'),
            new Key('cos', 'function'),
            new Key('tan', 'function'),
            new Key('C', 'operator'),
            new Key('delete', 'operator'),
            new key('sec', 'function'),
            new Key('csc', 'function'),
            new Key('cot', 'function'),
            new Key('x^2', 'operator'),
            new Key('x^n', 'operator'),
            new Key('sqrt', 'operator'),
            new Key('nthrt', 'operator'),
            new Key('n!', 'operator'),
            new Key('1/n', 'operator'),
            new Key('MEM', 'memory'),
            new Key('STO', 'memory'),
            new Key('M+', 'memory'),
            new key('7', 'number'),
            new key('8', 'number'),
            new key('9', 'number'),
            new key('/', 'operator'),
            new key('4', 'number'),
            new key('5', 'number'),
            new key('6', 'number'),
            new key('*', 'operator'),
            new key('1', 'number'),
            new key('2', 'number'),
            new key('3', 'number'),
            new key('-', 'operator'),
            new key('0', 'number'),
            new key('.', 'number'),
            new key('=', 'operator'),
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

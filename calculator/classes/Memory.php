<?php

declare(strict_types=1);

class Memory
{
    private array $memory = [];

    public function __construct()
    {
        $this->memory = [];
    }

    public function add(int $value): void
    {
        array_push($this->memory, $value);
    }

    public function remove(): void
    {
        array_pop($this->memory);
    }

    public function recall(): int
    {
        return $this->memory[count($this->memory) - 1];
    }

    public function get(): array
    {
        return $this->memory;
    }

    public function set(array $memory): void
    {
        $this->memory = $memory;
    }
}

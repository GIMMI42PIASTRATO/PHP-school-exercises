<?php

declare(strict_types=1);

class Key
{
    private string $value;
    private string $class;

    public function __construct(string $value, string $class)
    {
        $this->value = $value;
        $this->class = $class;
    }

    public function __toString(): string
    {
        return "<button type='submit' value='$this->value' name='input' class='$this->class'>$this->value</button>";
    }
}

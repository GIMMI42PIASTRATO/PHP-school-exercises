<?php

declare(strict_types=1);

class Key
{
    private string $type;
    private string $value;
    private string $name;
    private string $class;

    public function __construct(string $value, string $class, string $type = "button", string $name = "")
    {
        $this->type = $type;
        $this->value = $value;
        $this->name = $name;
        $this->class = $class;
    }

    public function __toString(): string
    {
        return "<button type='$this->type' value='$this->value' name='$this->name' class='$this->class'>$this->value</button>";
    }
}
